<?php

namespace Application\Service;

use Framework\UserConnect;
use Application\Entity\Reader;
use Framework\Error\LoginException;
use Application\Repository\UserRepository;

class LoginService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository;
        $this->userConnect = new UserConnect;
    }

    public function login(string $pseudo, string $password)
    {
        //Je vérifie que l'utilisateur existe
        $user = $this->repository->isUniqueEntity($pseudo);
        if (! $user) {
            throw new LoginException("L'utilisateur {$pseudo} n'a pas de compte.", 400);
        }

        //Je récupère l'utilisateur qui veut se connecter
        $userConnect = $this->repository->find($user['id']);

        //Si le compte de l'utilisateur n'est pas valide alors on ne l'autorise pas à se connecter
        if ($userConnect instanceof Reader) {
            if (! $userConnect->getIsValide()) {
                throw new LoginException("Votre compte n'a pas encore été validé.", 400);
            }
        }

        //Je compare les mots de passe
        if (! password_verify($password, $userConnect->getPassword())) {
            throw new LoginException("Votre mot de passe ne corresponds à celui enregistré.", 400);
        }

        var_dump($userConnect);

        $this->userConnect->addUserConnect($userConnect);
    }
    
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
    }
}