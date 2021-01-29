<?php

namespace Application\Service;

use Framework\UserConnect;
use Application\Entity\Post;
use Application\Service\CategoryService;
use Application\Repository\PostRepository;
use Application\Service\UploadFileService;

class PostService
{
    private PostRepository $repository;
    private UserConnect $user;
    private MediaService $mediaService;
    private CategoryService $categoryService;
    private UploadFileService $uploadFileService;

    public function __construct()
    {
        $this->repository = new PostRepository;
        $this->user = new UserConnect;
        $this->mediaService = new MediaService;
        $this->categoryService = new CategoryService;
        $this->uploadFileService = new UploadFileService('featured', 'post');
    }
    
    /**
     * getAll
     *
     * @return array
     */
    public function getAll(int $origin = null, int $number = null): array
    {
        return $this->repository->findAll($origin, $number);
    }

    /**
     * getPostsByCategory
     *
     * @return array
     */
    public function getPostsByCategory(string $slug, int $origin = null, int $number = null): array
    {
        $category = $this->categoryService->getCategoryBySlug($slug);

        return $this->repository->findPostsByCategory($category, $origin, $number);
    }
    
    /**
     * getPost
     *
     * @param  int $ident
     * @return Post
     */
    public function getPost(array $data): Post
    {
        return $this->repository->find($data);
    }
    
    /**
     * add
     *
     * @param  Post $post
     * @return void
     */
    public function add(Post $post)
    {
        //Fichier télécharger
        $uploadFile = $this->uploadFileService->generateMedia();
        $featured = $this->mediaService->add($uploadFile);
        $post->setFeatured($featured);

        //Déplacement du fichier dans le dossier correspondant
        $this->uploadFileService->moveFile($featured->getName());

        $post->setSlug($this->slugify($post->getTitle()));
        $post->setAutor($this->user->getUserConnect());

        $this->repository->persist($post);
    }
    
    /**
     * edit
     *
     * @param  Post $post
     * @return void
     */
    public function edit(Post $post)
    {
        //Si une image à été uploadée
        if ($this->uploadFileService->isUpload()) {
            //Je garde l'ancien url pour la suppression
            $lastUrl = $post->getFeatured()->getUrl();

            //Je modifie les données du média et les enregistre
            $uploadFile = $this->uploadFileService->generateMedia($post->getFeatured());
            $featured = $this->mediaService->edit($uploadFile);

            //Déplacement du fichier et suppression de l'ancien
            $this->uploadFileService->moveFile($featured->getName());
            $this->uploadFileService->deleteFile($lastUrl);
        }

        $post->setEditedAt(new \DateTime);
        $post->setSlug($this->slugify($post->getTitle()));
        $post->setAutor($this->user->getUserConnect());

        $this->repository->edit($post);
    }
    
    /**
     * delete
     *
     * @param  Post $post
     * @return void
     */
    public function delete(Post $post)
    {
        $media = $post->getFeatured();

        $this->repository->delete($post);

        $this->mediaService->delete($media);
        $this->uploadFileService->deleteFile($media->getUrl());
    }

    /**
     * slugify
     *
     * @param  string $string
     * @param  string|null $delimiter
     * @return string
     */
    private function slugify(string $string, ?string $delimiter = '-')
    {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        return $clean;
    }
}