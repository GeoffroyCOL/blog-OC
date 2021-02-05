<?php

namespace Application\Entity;

use Framework\Manager\EntityManager;

class Category extends EntityManager
{
    private int $id;
    private string $name;
    private string $slug;

    /**
     * Get the value of ident
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of ident
     *
     * @param  int $ident
     * @return  self
     */
    public function setId(int $ident): self
    {
        $this->id = $ident;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string $name
     * @return  self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
