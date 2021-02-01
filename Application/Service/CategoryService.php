<?php

namespace Application\Service;

use Application\Entity\Category;
use Application\Repository\CategoryRepository;

class CategoryService
{
    private CategoryRepository $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository;
    }
    
    /**
     * add
     *
     * @param  Category $category
     * @return void
     */
    public function add(Category $category): void
    {
        $category->setSlug($this->slugify($category->getName()));
        $this->repository->persist($category);
    }
    
    /**
     * edit
     *
     * @param  Category $category
     * @return void
     */
    public function edit(Category $category): void
    {
        $category->setSlug($this->slugify($category->getName()));
        $this->repository->edit($category);
    }
    
    /**
     * delete
     *
     * @param  Category $category
     * @return void
     */
    public function delete(Category $category): void
    {
        $this->repository->delete($category);
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
     * getCategory
     *
     * @param  int $ident
     * @return Category
     */
    public function getCategory(int $ident): Category
    {
        return $this->repository->find($ident);
    }

    /**
     * getCategory
     *
     * @param  string $slug
     * @return Category
     */
    public function getCategoryBySlug(string $slug): Category
    {
        return $this->repository->findBySlug($slug);
    }

    /**
     * numberPost
     *
     * @return int
     */
    public function numberPost(): int
    {
        return $this->repository->findNumberCategory();
    }
    
    /**
     * slugify
     *
     * @param  string $string
     * @param  string|null $delimiter
     * @return string
     */
    public function slugify(string $string, ?string $delimiter = '-'): string
    {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        return $clean;
    }
}
