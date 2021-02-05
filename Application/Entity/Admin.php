<?php

namespace Application\Entity;

class Admin extends User
{
    protected int $ident;

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
}
