<?php

namespace Application\Entity;

abstract class User
{
    protected int $id;
    protected string $pseudo;
    protected string $password;
    protected string $role;
    protected DateTime $createdAt;
    protected DateTime $connectedAt;
    protected Media $avatar;

    public function __construct()
    {
        $this->createdAt = new \Date();
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
     * Get the value of pseudo
     * 
     * @return string
     */ 
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param  string $pseudo
     * @return  self
     */ 
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of password
     * 
     * @return string
     */ 
    public function getPassword(): string 
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string $password
     * @return  self
     */ 
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     * 
     * @return string
     */ 
    public function getRole(): string 
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  string $role
     * @return  self
     */ 
    public function setRole(string $role): self
    {
        $this->role = $role;

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
     * @param  DateTime $createdAt
     * @return  self
     */ 
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of connectedAt
     * 
     * @return DateTime|null
     */ 
    public function getConnectedAt(): ?\DateTime
    {
        return $this->connectedAt;
    }

    /**
     * Set the value of connectedAt
     *
     * @param  DateTime|null $connectedAt
     * @return  self
     */ 
    public function setConnectedAt(?\DateTime $connectedAt): self
    {
        $this->connectedAt = $connectedAt;

        return $this;
    }

    /**
     * Get the value of avatar
     * 
     * @return Media
     */ 
    public function getAvatar(): Media
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @param  Media $avatar
     * @return  self
     */ 
    public function setAvatar(Media $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
}
