<?php

namespace Framework;

use Framework\HTTP\Request;
use Application\Entity\User;
use Framework\HTTP\Response;

class UserConnect
{    
    /**
     * addUserConnect
     *
     * @param  User $user
     * @return void
     */
    public function addUserConnect(User $user)
    {
        $_SESSION['user'] = serialize($user);
    }
    
    /**
     * getUserConnect
     *
     * @return User|null
     */
    public function getUserConnect(): ?User
    {
        if (isset($_SESSION['user'])) {
            return unserialize($_SESSION['user']);
        }

        return null;
    }
}