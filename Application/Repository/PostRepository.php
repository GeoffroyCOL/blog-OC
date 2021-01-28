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
            $lists[] = $this->entity->generateEntity($data, 'post');
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

        if (! $data) {
            throw new NotFoundEntityException("L'article n'existe pas", 400);
        }

        return $this->entity->generateEntity($data, 'post');;
    }
    
    /**
     * persist
     *
     * @param  Post $post
     * @return void
     */
    public function persist(Post $post)
    {
        $request = $this->bdd->prepare(
            'INSERT INTO post(title, slug, content, createdAt, category, featured, autor) 
                VALUES(:title, :slug, :content, :createdAt, :category, :featured, :autor)
        ');

        $request->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $request->bindValue(':slug', $post->getSlug(), \PDO::PARAM_STR);
        $request->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $request->bindValue(':createdAt', $post->getCreatedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $request->bindValue(':category', $post->getCategory()->getId(), \PDO::PARAM_INT);
        $request->bindValue(':featured', $post->getFeatured()->getId(), \PDO::PARAM_INT);
        $request->bindValue(':autor', $post->getAutor()->getId(), \PDO::PARAM_INT);

        $request->execute();
    }

    /**
     * persist
     *
     * @param  Post $post
     * @return void
     */
    public function edit(Post $post)
    {
        $request = $this->bdd->prepare(
            'UPDATE post 
                SET title = :title, slug = :slug, content = :content, createdAt = :createdAt, editedAt = :editedAt, category = :category, autor = :autor, featured = :featured
                WHERE id = :id
        ');

        $request->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        $request->bindValue(':title', $post->getTitle(), \PDO::PARAM_STR);
        $request->bindValue(':slug', $post->getSlug(), \PDO::PARAM_STR);
        $request->bindValue(':content', $post->getContent(), \PDO::PARAM_STR);
        $request->bindValue(':createdAt', $post->getCreatedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $request->bindValue(':editedAt', $post->getEditedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $request->bindValue(':category', $post->getCategory()->getId(), \PDO::PARAM_INT);
        $request->bindValue(':featured', $post->getFeatured()->getId(), \PDO::PARAM_INT);
        $request->bindValue(':autor', $post->getAutor()->getId(), \PDO::PARAM_INT);

        $request->execute();
    }
    
    /**
     * delete
     *
     * @param  Post $post
     * @return void
     */
    public function delete(Post $post)
    {
        $request = $this->bdd->prepare('DELETE FROM post WHERE id = :id LIMIT 1');
        $request->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        
        $request->execute();
    }
}