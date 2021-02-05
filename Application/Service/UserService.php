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
    public function edit(User $user): void
    {
        if ($this->uploadFileService->isUpload()) {
            if ($user->getAvatar()) {
                //Je garde l'ancien url pour la suppression
                $lastUrl = $user->getAvatar()->getUrl();

                //Je modifie les données du média et les enregistre
                $uploadFile = $this->uploadFileService->generateMedia($user->getAvatar());
                $avatar = $this->mediaService->edit($uploadFile);

                //Déplacement du fichier et suppression de l'ancien
                $this->uploadFileService->moveFile($avatar->getName());
                $this->uploadFileService->deleteFile($lastUrl);
            }

            if (! $user->getAvatar()) {
                $uploadFile = $this->uploadFileService->generateMedia();
                $avatar = $this->mediaService->add($uploadFile);

                //Déplacement du fichier et suppression de l'ancien
                $this->uploadFileService->moveFile($avatar->getName());
                $user->setAvatar($avatar);
            }
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
    public function delete(User $user): void
    {
        $media = $user->getAvatar();

        $this->repository->delete($user);

        if ($media) {
            $this->mediaService->delete($media);
            $this->uploadFileService->deleteFile($media->getUrl());
        }
    }
    
    /**
     * getAll
     *
     * @param  int|null $origin
     * @param  int|null $number
     * @return array
     */
    public function getAll(int $origin = null, int $number = null): array
    {
        return $this->repository->findAll($origin, $number);
    }
    
    /**
     * valide
     *
     * @param  int $ident
     * @return void
     */
    public function valide(int $ident): void
    {
        $this->repository->valide($ident);
    }

    /**
     * numberPost
     *
     * @return int
     */
    public function numberUser(): int
    {
        return $this->repository->findNumberUser();
    }
}
