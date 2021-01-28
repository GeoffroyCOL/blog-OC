<?php

namespace Application\Service;

use Application\Entity\Post;
use Application\Repository\PostRepository;

class PostService
{
    private PostRepository $repository;

    public function __construct()
    {
        $this->repository = new PostRepository;
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
}