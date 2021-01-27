<?php

namespace Application\Service;

use Framework\UserConnect;
use Framework\HTTP\Request;
use Application\Entity\User;
use Application\Service\LoginService;
use Application\Service\MediaService;
use Application\Repository\UserRepository;

class UserService
{
    private UserRepository $repository;
    private MediaService $mediaService;
    private Request $request;
    private UserConnect $userConnect;
    private LoginService $loginService;

    public function __construct()
    {
        $this->repository = new UserRepository;
        $this->mediaService = new MediaService;
        $this->request = new Request;
        $this->userConnect = new UserConnect;
        $this->loginService = new LoginService;
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
    
    /**
     * add
     *
     * @param  User $user
     * @return void
     */
    public function add(User $user): void
    {
        if (! empty($_FILES['avatar']['name'])) {
            $avatar = $this->mediaService->add($_FILES['avatar'], 'user');
            $user->setAvatar($avatar);
        }

        $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

        $this->repository->persist($user);
    }
    
    /**
     * edit
     *
     * @param  User $user
     * @return void
     */
    public function edit(User $user)
    {
        if (! empty($_FILES['avatar']['name'])) {
            if ($user->getAvatar()) {
                $avatar = $this->mediaService->edit($user->getAvatar(), $_FILES['avatar'], 'user');
            } else {
                $avatar = $avatar = $this->mediaService->add($_FILES['avatar'], 'user');
            }
            $user->setAvatar($avatar);
        }

        if ($user->getNewPassword()) {
            $user->setPassword(password_hash($user->getNewPassword(), PASSWORD_DEFAULT));
        }

        $this->repository->edit($user);
        $this->userConnect->addUserConnect($user);
    }
    
    /**
     * delete
     *
     * @param  User $user
     * @return void
     */
    public function delete(User $user)
    {
        $media = $user->getAvatar();

        $this->repository->delete($user);

        if ($media) {
            $this->mediaService->delete($media);
        }

        $this->loginService->logout();
    }
    
    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function valide(int $ident)
    {
        $this->repository->valide($ident);
    }
}
