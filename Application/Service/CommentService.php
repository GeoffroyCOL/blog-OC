<?php

namespace Application\Service;

use Application\Entity\Post;
use Application\Entity\Comment;
use Application\Repository\CommentRepository;

class CommentService 
{
    private CommentRepository $repository;

    public function __construct()
    {
        $this->repository = new CommentRepository;
    }
    
    /**
     * add
     *
     * @param  Comment $comment
     * @return void
     */
    public function add(Comment $comment)
    {
        if ($comment->getAutor()->getRole() === 'admin') {
            $comment->setIsValide(true);
        }

        $this->repository->persist($comment);
    }
    
    /**
     * delete
     *
     * @param  Comment $comment
     * @return void
     */
    public function delete(Comment $comment)
    {
        $this->repository->delete($comment);
    }

    /**
     * delete
     *
     * @param  Comment $comment
     * @return void
     */
    public function valide(Comment $comment)
    {
        $this->repository->valide($comment);
    }
    
    /**
     * getCommentForPost
     * 
     * Récupère la liste des commentaires d'un article
     *
     * @param  Post $post
     * @return array
     */
    public function getCommentForPost(Post $post): array
    {
        return $this->repository->findCommentForPost($post);
    }
    
    /**
     * getcomment
     *
     * @param  int $ident
     * @return Comment
     */
    public function getcomment(int $ident): Comment
    {
        return $this->repository->find($ident);
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
     * numberPost
     *
     * @return int
     */
    public function numberPost(): int
    {
        return $this->repository->findNumberComment();
    }
}