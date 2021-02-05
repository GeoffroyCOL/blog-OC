<?php

namespace Application\Entity;

use Framework\Manager\EntityManager;

abstract class User extends EntityManager
{
    protected int $id;
    protected string $pseudo;
    protected string $email;
    protected string $password;
    protected ?string $newPassword = "";
    protected string $role;
    protected \DateTime $createdAt;
    protected ?\DateTime $connectedAt = null;
    protected ?Media $avatar = null;

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
     * @return Media|null
     */
    public function getAvatar(): ?Media
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @param  Media|null $avatar
     * @return  self
     */
    public function setAvatar(?Media $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string $email
     * @return  self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of newPassword
     *
     * @return string|null
     */
    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     *
     * @param  string|null $newPassword
     * @return  self
     */
    public function setNewPassword(?string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }
}
