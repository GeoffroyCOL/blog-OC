<?php

namespace Application\Entity;

use Framework\Manager\EntityManager;

class Comment extends EntityManager
{
    private int $id;
    private User $autor;
    private \DateTime $createdAt;
    private ?\DateTime $editedAt = null;
    private ?Comment $parent = null;
    private bool $isValide;
    private Post $post;
    private string $content;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isValide = false;
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
    public function setId(int $ident): self
    {
        $this->id = $ident;

        return $this;
    }

    /**
     * Get the value of autor
     * 
     * @return User
     */ 
    public function getAutor(): User
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     *
     * @param  User $autor
     * @return  self
     */ 
    public function setAutor(User $autor): self
    {
        $this->autor = $autor;

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
     * @param DateTime $createdAt
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
     * @param  DateTime|null $editedAt
     * @return  self
     */ 
    public function setEditedAt(?\DateTime $editedAt): self
    {
        $this->editedAt = $editedAt;

        return $this;
    }

    /**
     * Get the value of parent
     * 
     * @return Comment|null
     */ 
    public function getParent(): ?Comment
    {
        return $this->parent;
    }

    /**
     * Set the value of parent
     *
     * @param  Comment|null $parent
     * @return  self
     */ 
    public function setParent(?Comment $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the value of isValide
     * 
     * @return bool
     */ 
    public function getIsValide(): bool
    {
        return $this->isValide;
    }

    /**
     * Set the value of isValide
     *
     * @param  bool $isValide
     * @return  self
     */ 
    public function setIsValide(bool $isValide): self
    {
        $this->isValide = $isValide;

        return $this;
    }

    /**
     * Get the value of post
     * 
     * @return Post
     */ 
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * Set the value of post
     *
     * @param  Post $post
     * @return  self
     */ 
    public function setPost(Post $post): self
    {
        $this->post = $post;

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
     * @return  string $content
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }
}