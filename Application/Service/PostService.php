<?php

namespace Application\Service;

use Framework\UserConnect;
use Application\Entity\Post;
use Application\Repository\PostRepository;

class PostService
{
    private PostRepository $repository;
    private UserConnect $user;
    private MediaService $mediaService;

    public function __construct()
    {
        $this->repository = new PostRepository;
        $this->user = new UserConnect;
        $this->mediaService = new MediaService;
    }
    
    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }
    
    /**
     * getPost
     *
     * @param  int $ident
     * @return Post
     */
    public function getPost(int $ident): Post
    {
        return $this->repository->find($ident);
    }
    
    /**
     * add
     *
     * @param  Post $post
     * @return void
     */
    public function add(Post $post)
    {
        if (! empty($_FILES['featured']['name'])) {
            $featured = $this->mediaService->add($_FILES['featured'], 'post');
            $post->setFeatured($featured);
        }

        $post->setSlug($this->slugify($post->getTitle()));
        $post->setAutor($this->user->getUserConnect());

        $this->repository->persist($post);
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