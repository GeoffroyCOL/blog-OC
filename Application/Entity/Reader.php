<?php

namespace Application\Entity;

class Reader extends User
{
    protected int $id;
    protected bool $isValide;

    public function __construct()
    {
        parent::__construct();

        $this->isValide = false;
        $this->role = 'reader';
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
}
