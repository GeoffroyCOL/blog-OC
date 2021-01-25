<?php

namespace Application\Service;

use Framework\HTTP\Request;
use Application\Entity\User;
use Application\Service\MediaService;
use Application\Repository\UserRepository;

class UserService
{
    private UserRepository $repository;
    private MediaService $mediaService;
    private Request $request;

    public function __construct()
    {
        $this->repository = new UserRepository;
        $this->mediaService = new MediaService;
        $this->request = new Request;
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

    public function add(User $user)
    {
        if (! empty($_FILES['avatar']['name'])) {
            $avatar = $this->mediaService->add($_FILES['avatar']);
            $user->setAvatar($avatar);
        }

        $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

        $this->repository->persist($user);
    }
}