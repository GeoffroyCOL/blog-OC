<?php

namespace Application\Repository;

use Application\Entity\Category;
use Framework\Error\NotFoundException;
use Framework\Manager\AbstractManager;

class CategoryRepository extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * find
     *
     * @param  int $ident
     * @return Category
     */
    public function find(int $ident): Category
    {
        $request = $this->bdd->prepare('SELECT id, name, slug FROM category WHERE id = :id');
        $request->bindValue(':id', $ident, \PDO::PARAM_INT);

        $request->execute();

        $data = $request->fetchObject("Application\Entity\Category");

        if (! $data) {
            throw new NotFoundException("La catégorie n'existe pas", 404);
        }

        return $data;
    }

    /**
     * findBySlug
     *
     * @param  string $slug
     * @return Category
     */
    public function findBySlug(string $slug): Category
    {
        $request = $this->bdd->prepare('SELECT id, name, slug FROM category WHERE slug = :slug');
        $request->bindValue(':slug', $slug, \PDO::PARAM_STR);

        $request->execute();

        $data = $request->fetchObject("Application\Entity\Category");

        if (! $data) {
            throw new NotFoundException("La catégorie n'existe pas", 404);
        }

        return $data;
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
        $sql = 'SELECT id, name, slug FROM category';

        if ($number) {
            $sql .= ' LIMIT :origin, :number';

            $origin *= $number;
        }

        $request = $this->bdd->prepare($sql);

        $request->bindParam(':origin', $origin, \PDO::PARAM_INT);
        $request->bindParam(':number', $number, \PDO::PARAM_INT);

        $request->execute();

        return $request->fetchAll(\PDO::FETCH_CLASS, "Application\Entity\Category");
    }

    /**
     * isUniqueEntity
     *
     * @param  string $category
     * @return array
     */
    public function isUniqueEntity(string $name): array
    {
        $request = $this->bdd->prepare('SELECT name FROM category WHERE name = :name');

        $request->bindValue(':name', $name, \PDO::PARAM_STR);
        $request->execute();

        return $request->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * persist
     *
     * @param  Category $category
     * @return void
     */
    public function persist(Category $category): void
    {
        $request = $this->bdd->prepare('INSERT INTO category(name, slug) VALUES(:name, :slug)');

        $request->bindValue(':name', $category->getName(), \PDO::PARAM_STR);
        $request->bindValue(':slug', $category->getSlug(), \PDO::PARAM_STR);
        
        $request->execute();
    }
    
    /**
     * edit
     *
     * @param  Category $category
     * @return void
     */
    public function edit(Category $category): void
    {
        $request = $this->bdd->prepare('UPDATE category SET name = :name, slug = :slug WHERE id = :id');

        $request->bindValue(':id', $category->getId(), \PDO::PARAM_INT);
        $request->bindValue(':name', $category->getName(), \PDO::PARAM_STR);
        $request->bindValue(':slug', $category->getSlug(), \PDO::PARAM_STR);

        $request->execute();
    }
    
    /**
     * delete
     *
     * @param  Category $category
     * @return void
     */
    public function delete(Category $category)
    {
        $request = $this->bdd->prepare('DELETE FROM category WHERE id = :id LIMIT 1');
        $request->bindValue(':id', $category->getId(), \PDO::PARAM_INT);
        
        $request->execute();
    }

    /**
     * findNumberCategory
     *
     * @return int
     */
    public function findNumberCategory(): int
    {
        $sql = 'SELECT COUNT(*) as number FROM category';

        $request = $this->bdd->prepare($sql);

        $request->execute();
        $result = $request->fetch(\PDO::FETCH_ASSOC);

        return $result['number'];
    }
}
