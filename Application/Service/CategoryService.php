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
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }
    
    /**
     * slugify
     *
     * @param  string $string
     * @param  string|null $delimiter
     * @return string
     */
    public function slugify(string $string, ?string $delimiter = '-')
    {
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        setlocale(LC_ALL, $oldLocale);
        return $clean;
    }
}
