<?php

namespace Application\Service;

use Framework\UserConnect;
use Framework\HTTP\Request;
use Application\Entity\User;
use Application\Service\LoginService;
use Application\Service\MediaService;
use Application\Repository\UserRepository;
use Application\Service\UploadFileService;

class UserService
{
    private UserRepository $repository;
    private MediaService $mediaService;
    private Request $request;
    private UserConnect $userConnect;
    private LoginService $loginService;
    private UploadFileService $uploadFileService;

    public function __construct()
    {
        $this->repository = new UserRepository;
        $this->mediaService = new MediaService;
        $this->request = new Request;
        $this->userConnect = new UserConnect;
        $this->loginService = new LoginService;
        $this->uploadFileService = new UploadFileService('avatar', 'user');
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
        if ($this->uploadFileService->isUpload()) {
            $uploadFile = $this->uploadFileService->generateMedia();
            $avatar = $this->mediaService->add($uploadFile);

            //Déplacement du fichier et suppression de l'ancien
            $this->uploadFileService->moveFile($avatar->getName());
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
        if ($this->uploadFileService->isUpload()) {
            //Je garde l'ancien url pour la suppression
            $lastUrl = $user->getavatar()->getUrl();

            //Je modifie les données du média et les enregistre
            $uploadFile = $this->uploadFileService->generateMedia($user->getAvatar());
            $avatar = $this->mediaService->edit($uploadFile);

            //Déplacement du fichier et suppression de l'ancien
            $this->uploadFileService->moveFile($avatar->getName());
            $this->uploadFileService->deleteFile($lastUrl);
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
            $this->uploadFileService->deleteFile($media->getUrl());
        }

        //Déconnection de l'utilisateur avec sa suppression
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
    
    /**
     * valide
     *
     * @param  int $ident
     * @return void
     */
    public function valide(int $ident)
    {
        $this->repository->valide($ident);
    }
}
