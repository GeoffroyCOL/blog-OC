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
    public function add(Comment $comment): void
    {
        if ($comment->getAutor()->getRole() === 'admin') {
            $comment->setIsValide(true);
        }

        $this->repository->persist($comment);
    }
    
    /**
     * edit
     *
     * @param  Comment $comment
     * @return void
     */
    public function edit(Comment $comment): void
    {
        $comment->setEditedAt(new \Datetime);
        $this->repository->edit($comment);
    }
    
    /**
     * delete
     *
     * @param  Comment $comment
     * @return void
     */
    public function delete(Comment $comment): void
    {
        $this->repository->delete($comment);
    }

    /**
     * delete
     *
     * @param  Comment $comment
     * @return void
     */
    public function valide(Comment $comment): void
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
     * @param  int|null $origin
     * @param  int|null $number
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
