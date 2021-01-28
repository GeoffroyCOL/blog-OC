<?php

namespace Application\Entity;

use Framework\Manager\EntityManager;

class Post extends EntityManager
{
    private int $id;
    private string $title;
    private string $slug;
    private string $content;
    private \DateTime $createdAt;
    private ?\DateTime $editedAt = null;
    private Admin $autor;
    private Category $category;
    private Media $featured;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int $id
     * @return  self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string $title
     * @return  self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     * 
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string $content
     * @return  self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of slug
     * 
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @param  string $slug
     * @return  self
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of createdAt
     * 
     * @return DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of editedAt
     * 
     * @return DateTime|null
     */
    public function getEditedAt(): ?\DateTime
    {
        return $this->editedAt;
    }

    /**
     * Set the value of editedAt
     *
     * @param  DateTime|null $createdAt
     * @return  self
     */
    public function setEditedAt(?\DateTime $editedAt): self
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    /**
     * Get the value of autor
     * 
     * @return Admin
     */
    public function getAutor(): Admin
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     *
     * @param  Admin $autor
     * @return  self
     */
    public function setAutor(Admin $autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of category
     * 
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param  Category $category
     * @return  self
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of featured
     * 
     * @return Media
     */ 
    public function getFeatured(): Media
    {
        return $this->featured;
    }

    /**
     * Set the value of featured
     * 
     * @param  Media $featured
     * @return  self
     */ 
    public function setFeatured(Media $featured): self
    {
        $this->featured = $featured;

        return $this;
    }
}
