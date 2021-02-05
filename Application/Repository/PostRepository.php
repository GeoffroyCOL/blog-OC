<?php

namespace Application\Repository;

use Application\Entity\Post;
use Application\Entity\Category;
use Framework\Error\NotFoundException;
use Framework\Manager\AbstractManager;
use Application\Repository\UserRepository;
use Application\Repository\MediaRepository;
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
     * @param  int|null $origin
     * @param  int|null $number
     * @return array
     */
    public function findAll(int $origin = null, int $number = null): array
    {
        $lists = [];

        $sql = 'SELECT id, title, slug, content, autor, category, createdAt, featured, editedAt FROM post ORDER BY createdAt DESC';

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
            $lists[] = $this->entity->generateEntity($data, 'post');
        }

        return $lists;
    }

    /**
     * findAll
     *
     * @param  Category $category
     * @param  int|null $origin
     * @param  int|null $number
     * @return array
     */
    public function findPostsByCategory(Category $category, int $origin = null, int $number = null): array
    {
        $lists = [];

        $sql =
            'SELECT id, title, slug, content, autor, category, createdAt, featured, editedAt FROM post 
                WHERE category = :category
                ORDER BY createdAt DESC';

        if ($number) {
            $sql .= ' LIMIT :origin, :number';

            $origin *= $number;
        }

        $request = $this->bdd->prepare($sql);

        $catId = $category->getId();
        $request->bindParam(':category', $catId, \PDO::PARAM_INT);
        if ($number) {
            $request->bindParam(':origin', $origin, \PDO::PARAM_INT);
            $request->bindParam(':number', $number, \PDO::PARAM_INT);
        }

        $request->execute();

        $datas = $request->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($datas as $data) {
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
        $request->bindValue(':id', $ident);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        if (! $data) {
            throw new NotFoundException("L'article n'existe pas", 404);
        }

        return $this->entity->generateEntity($data, 'post');
        ;
    }

    /**
     * find
     *
     * @param  string $string
     * @return Post
     */
    public function findBySlug(string $slug): Post
    {
        $request = $this->bdd->prepare('SELECT id, title, slug, content, autor, category, createdAt, featured, editedAt FROM post WHERE slug = :slug');
        $request->bindValue(':slug', $slug);
        $request->execute();

        $data = $request->fetch(\PDO::FETCH_ASSOC);

        if (! $data) {
            throw new NotFoundException("L'article n'existe pas", 404);
        }

        return $this->entity->generateEntity($data, 'post');
        ;
    }
    
    /**
     * persist
     *
     * @param  Post $post
     * @return void
     */
    public function persist(Post $post): void
    {
        $request = $this->bdd->prepare(
            'INSERT INTO post(title, slug, content, createdAt, category, featured, autor) 
                VALUES(:title, :slug, :content, :createdAt, :category, :featured, :autor)
        '
        );

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
    public function edit(Post $post): void
    {
        $request = $this->bdd->prepare(
            'UPDATE post 
                SET title = :title, slug = :slug, content = :content, createdAt = :createdAt, editedAt = :editedAt, category = :category, autor = :autor, featured = :featured
                WHERE id = :id'
        );

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
    public function delete(Post $post): void
    {
        $request = $this->bdd->prepare('DELETE FROM post WHERE id = :id LIMIT 1');
        $request->bindValue(':id', $post->getId(), \PDO::PARAM_INT);
        
        $request->execute();
    }

    /**
     * isUniqueEntity
     *
     * @param  string $title
     * @return array|bool
     */
    public function isUniqueEntity(string $title)
    {
        $request = $this->bdd->prepare('SELECT title FROM post WHERE title = :title');

        $request->bindValue(':title', $title, \PDO::PARAM_STR);
        $request->execute();

        return $request->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * findNumberPost
     *
     * @param  string|null $str
     * @return int
     */
    public function findNumberPost(?string $str = ''): int
    {
        $sql = 'SELECT COUNT(*) as number FROM post';

        if ($str) {
            $sql .= ' WHERE category = :category';
        }

        $request = $this->bdd->prepare($sql);
        $request->bindValue(':category', $str, \PDO::PARAM_STR);

        $request->execute();
        $result = $request->fetch(\PDO::FETCH_ASSOC);

        return $result['number'];
    }
}
