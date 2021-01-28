<?php

namespace Application\Repository;

use Application\Entity\Post;
use Framework\Manager\AbstractManager;
use Application\Repository\UserRepository;
use Application\Repository\MediaRepository;
use Framework\Error\NotFoundEntityException;
use Application\Repository\CategoryRepository;

class PostRepository extends AbstractManager
{
    private UserRepository $userRepository;
    private CategoryRepository $categoryRepository;
    private MediaRepository $mediaRepository;

    public function __construct()
    {
        parent::__construct();

        $this->userRepository = new UserRepository;
        $this->categoryRepository = new CategoryRepository;
        $this->mediaRepository = new MediaRepository;
    }
    
    /**
     * findAll
     *
     * @return array
     */
    public function findAll(): array
    {
        $lists = [];

        $request = $this->bdd->prepare('SELECT id, title, slug, content, autor, category, createdAt, featured, editedAt FROM post');
        $request->execute();

        $datas = $request->fetchAll(\PDO::FETCH_ASSOC);

        foreach($datas as $data) {
            $lists[] = $this->generateEntityForPost($data);
        }

        return $lists;
    }
    
    /**
     * find
     *
     * @param  int $ident
     * @return Post
     */
    public function find(int $ident): Post
    {
        $request = $this->bdd->prepare('SELECT id, title, slug, content, autor, category, createdAt, featured, editedAt FROM post WHERE id = :id');
        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        $post = $this->generateEntityForPost($data);

        return $post;
    }
    
    /**
     * generateEntityForPost
     *
     * @param  array $data
     * @return Post
     */
    private function generateEntityForPost(array $data): Post
    {
        $autor = $this->userRepository->find((int) $data['autor']);
        $category = $this->categoryRepository->find((int) $data['category']);
        $featured = $this->mediaRepository->find((int) $data['featured']);
        $createdAt = new \DateTime($data['createdAt']);

        $data['autor'] = $autor;
        $data['category'] = $category;
        $data['createdAt'] = $createdAt;
        $data['featured'] = $featured;

        $post = new Post;
        $post->hydrate($data);

        return $post;
    }
}