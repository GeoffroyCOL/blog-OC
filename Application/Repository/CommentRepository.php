<?php

namespace Application\Repository;

use Application\Entity\Post;
use Application\Entity\Comment;
use Framework\Error\NotFoundException;
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
    public function persist(Comment $comment): void
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
     * edit
     *
     * @param  comment $comment
     * @return void
     */
    public function edit(Comment $comment): void
    {
        $request = $this->bdd->prepare('UPDATE comment SET content = :content, editedAt = :editedAt WHERE id = :id');

        $request->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        $request->bindValue(':content', $comment->getContent(), \PDO::PARAM_STR);
        $request->bindValue(':editedAt', $comment->getEditedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);

        $request->execute();
    }
    
    /**
     * delete
     *
     * @param  Comment $comment
     * @return void
     */
    public function delete(Comment $comment): void
    {
        $request = $this->bdd->prepare('DELETE FROM comment WHERE id = :id LIMIT 1');
        $request->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        
        $request->execute();
    }

    /**
     * valide
     *
     * @param  Comment $comment
     * @return void
     */
    public function valide(Comment $comment): void
    {
        $request = $this->bdd->prepare('UPDATE comment SET isValide = :isValide WHERE id = :id');
        $request->bindValue(':id', $comment->getId(), \PDO::PARAM_INT);
        $request->bindValue(':isValide', true, \PDO::PARAM_BOOL);
        
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
    
    /**
     * find
     *
     * @param  int $ident
     * @return comment
     */
    public function find(int $ident): Comment
    {
        $request = $this->bdd->prepare('SELECT id, autor, content, post, createdAt, editedAt, parent, isValide FROM comment WHERE id = :id');
        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        if (! $data) {
            throw new NotFoundException("Le commentaire n'existe pas", 404);
        }

        return $this->entity->generateEntity($data, 'comment');
    }
    
    /**
     * findAll
     *
     * @param  int|null $origin
     * @param  int|null $number
     * @return array
     */
    public function findAll(int $origin = null, int $number = null): array
    {
        $lists = [];

        $sql = 'SELECT id, autor, content, post, createdAt, editedAt, parent, isValide FROM comment';

        if ($number) {
            $sql .= ' LIMIT :origin, :number';

            $origin *= $number;
        }

        $request = $this->bdd->prepare($sql);

        $request->bindParam(':origin', $origin, \PDO::PARAM_INT);
        $request->bindParam(':number', $number, \PDO::PARAM_INT);

        $request->execute();

        $datas = $request->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($datas as $data) {
            $lists[] = $this->entity->generateEntity($data, 'comment');
        }

        return $lists;
    }

    /**
     * findNumberComment
     *
     * @return int
     */
    public function findNumberComment(): int
    {
        $sql = 'SELECT COUNT(*) as number FROM comment';

        $request = $this->bdd->prepare($sql);

        $request->execute();
        $result = $request->fetch(\PDO::FETCH_ASSOC);

        return $result['number'];
    }
}
