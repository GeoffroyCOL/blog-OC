<?php

namespace Application\Service;

use Application\Entity\Media;
use Application\Repository\MediaRepository;

class MediaService
{
    private MediaRepository $repository;

    public function __construct()
    {
        $this->repository = new MediaRepository;
    }
    
    /**
     * add
     *
     * @param  array $data
     * @param  string $entity
     * @return Media
     */
    public function add(array $data, string $entity): Media
    {
        $avatar = new Media;
        $avatar->setAlt('avatar');

        $fileName = $data['tmp_name'];

        $this->hydrateMedia($avatar, $data);

        $media = $this->repository->persist($avatar);
        $avatar->setUrl(DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . DIRECTORY_SEPARATOR . $avatar->getName());

        move_uploaded_file($fileName, filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . '/' . $avatar->getName());
        
        return $media;
    }

    public function edit(Media $avatar, array $data, string $entity)
    {
        $fileName = $data['tmp_name'];

        //Récupère l'url du média pour le supprimer
        $lastUrl = $avatar->getUrl();
        
        $this->hydrateMedia($avatar, $data);

        $avatar->setUrl(DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . DIRECTORY_SEPARATOR . $avatar->getName());

        $media = $this->repository->edit($avatar);

        //Si le media a bine été modifié, alors on supprime l'ancienne contenu dans le dossier img
        if (file_exists(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'). $lastUrl)) {
            unlink(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'). $lastUrl);
        }
        
        move_uploaded_file($fileName, filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . '/' . $media->getName());
        
        return $media;
    }
    
    /**
     * hydrateMedia
     *
     * @return void
     */
    private function hydrateMedia(Media $avatar, array $data)
    {
        $avatar->setExtension(explode('/', htmlentities($data['type']))[1]);

        $name = explode('.', htmlentities($data['name']))[0];
        $nameMedia = $name . '-' . uniqid() .'.'. $avatar->getExtension();
        $avatar->setName($nameMedia);
    }
}