<?php

namespace Application\Service;

use Application\Entity\User;
use Application\Repository\UserRepository;

class UserService
{
    public function __construct()
    {
        $this->repository = new UserRepository();
    }
    
    /**
     * getUser
     *
     * @param  int $ident
     * @return User
     */
    public function getUser(int $ident): User
    {
        return $this->repository->find($ident);
    }
}