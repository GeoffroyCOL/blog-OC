<?php

namespace Application\Repository;

use Application\Entity\Category;
use Framework\Manager\AbstractManager;
use Framework\Error\NotFoundEntityException;

class CategoryRepository extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * findAll
     *
     * @return array
     */
    public function findAll(): array
    {
        $request = $this->bdd->prepare('SELECT id, name, slug FROM category');
        $request->execute();

        return $request->fetchAll(\PDO::FETCH_CLASS, "Application\Entity\Category");
    }

    /**
     * isUniqueEntity
     *
     * @param  string $category
     * @return bool
     */
    public function isUniqueEntity(string $name)
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

}