<?php

namespace Framework;

use Framework\HTTP\Request;
use Application\Entity\User;
use Framework\HTTP\Response;
use Framework\Session\Session;

class UserConnect
{    
    private Session $session;

    public function __construct()
    {
        $this->session = New Session;
    }

    /**
     * addUserConnect
     *
     * @param  User $user
     * @return void
     */
    public function addUserConnect(User $user)
    {
        $this->session->set('user', serialize($user));
        //$_SESSION['user'] = serialize($user);
    }
    
    /**
     * getUserConnect
     *
     * @return User|null
     */
    public function getUserConnect(): ?User
    {
        if ($this->session->get('user')) {
            return unserialize($this->session->get('user'));
        }

        /*if (isset($_SESSION['user'])) {
            return unserialize($_SESSION['user']);
        }*/

        return null;
    }
}