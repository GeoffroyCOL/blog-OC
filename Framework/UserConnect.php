<?php

namespace Framework;

use Framework\HTTP\Request;
use Application\Entity\User;
use Framework\HTTP\Response;

class UserConnect
{    
    private Response $response;
    private Request $request;

    public function __construct()
    {
        $this->response = new Response;
        $this->request = new Request;
    }

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
        if ($_SESSION['user']) {
            return unserialize($_SESSION['user']);
        }
    }
}