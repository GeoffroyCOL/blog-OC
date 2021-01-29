<?php

namespace Application\Repository;

use Application\Entity\Post;
use Application\Entity\Comment;
use Framework\Manager\AbstractManager;

class CommentRepository extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * persist
     *
     * @param  Comment $comment
     * @return void
     */
    public function persist(Comment $comment)
    {
        $request = $this->bdd->prepare(
            'INSERT INTO comment(autor, post, createdAt, parent, isValide, content ) 
                VALUES(:autor, :post, :createdAt, :parent, :isValide, :content)'
        );

        $request->bindValue(':autor', $comment->getAutor()->getId(), \PDO::PARAM_INT);
        $request->bindValue(':post', $comment->getPost()->getId(), \PDO::PARAM_INT);
        $request->bindValue(':createdAt', $comment->getCreatedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $request->bindValue(':isValide', $comment->getIsValide(), \PDO::PARAM_BOOL);
        $request->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);

        $parent = $comment->getParent() ? $comment->getParent()->getId() : null;
        $request->bindValue(':parent', $parent, \PDO::PARAM_INT | \PDO::PARAM_NULL);

        $request->execute();
    }
    
    /**
     * findCommentForPost
     *
     * @param  Post $post
     * @return array
     */
    public function findCommentForPost(Post $post): array
    {
        $lists = [];

        $request = $this->bdd->prepare('SELECT id, autor, content, post, createdAt, editedAt, parent FROM comment WHERE post = :post AND isValide = :isValide');
        $request->bindValue(':post', $post->getId(), \PDO::PARAM_INT);
        $request->bindValue(':isValide', true, \PDO::PARAM_BOOL);
        $request->execute();

        $datas = $request->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($datas as $data) {
            $lists[] = $this->entity->generateEntity($data, 'comment');
        }

        return $lists;
    }

    public function find(int $ident): comment
    {
        $request = $this->bdd->prepare('SELECT id, autor, content, post, createdAt, editedAt, parent FROM comment WHERE id = :id');
        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        return $this->entity->generateEntity($data, 'comment');
    }
}