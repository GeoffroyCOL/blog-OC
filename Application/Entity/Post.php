<?php

namespace Application\Entity;

use Framework\Manager\EntityManager;

class Post extends EntityManager
{
    private int $ident;
    private string $title;
    private string $slug;
    private string $content;
    private \DateTime $createdAt;
    private ?\DateTime $editedAt = null;
    private Admin $autor;
    private Category $category;
    private Media $featured;
    private ?string $link = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get the value of ident
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->ident;
    }

    /**
     * Set the value of ident
     *
     * @param  int $ident
     * @return  self
     */
    public function setId(int $ident): self
    {
        $this->ident = $ident;

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
    public function setCreatedAt(\DateTime $createdAt): self
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

    /**
     * Get the value of link
     */ 
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @param  string|byll $link
     * @return  self
     */ 
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
