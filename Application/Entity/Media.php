<?php

namespace Application\Entity;

class Media
{
    private int $id;
    private string $name;
    private string $alt;
    private string $extension;

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
     * Get the value of alt
     * 
     * @return string|null
     */ 
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * Set the value of alt
     *
     * @param  string|null $alt
     * @return  self
     */ 
    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get the value of extension
     * 
     * @return string
     */ 
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * Set the value of extension
     *
     * @param  string $extension
     * @return  self
     */ 
    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }
}