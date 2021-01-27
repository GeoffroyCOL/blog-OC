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

        //Récupère le nom du fichier téléchargé
        $fileName = $data['tmp_name'];

        $avatar->setAlt('avatar');
        $avatar->setExtension(explode('/', htmlentities($data['type']))[1]);

        $name = explode('.', htmlentities($data['name']))[0];
        $nameMedia = $name . '-' . uniqid() .'.'. $avatar->getExtension();
        $avatar->setName($nameMedia);

        $avatar->setUrl(DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . DIRECTORY_SEPARATOR . $avatar->getName());

        $media = $this->repository->persist($avatar);

        move_uploaded_file($fileName, filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . '/' . $avatar->getName());
        
        return $media;
    }

    public function edit(Media $avatar, array $data, string $entity)
    {
        $lastUrl = $avatar->getUrl();
        
        //Récupère le nom du fichier téléchargé
        $fileName = $data['tmp_name'];

        $avatar->setExtension(explode('/', htmlentities($data['type']))[1]);

        $name = explode('.', htmlentities($data['name']))[0];
        $nameMedia = $name . '-' . uniqid() .'.'. $avatar->getExtension();
        $avatar->setName($nameMedia);

        $avatar->setUrl(DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . DIRECTORY_SEPARATOR . $avatar->getName());

        $media = $this->repository->edit($avatar);

        //Si le media a bine été modifié, alors on supprime l'ancienne contenu dans le dossier img
        if (file_exists(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'). $lastUrl)) {
            unlink(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'). $lastUrl);
        }
        
        move_uploaded_file($fileName, filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . DIRECTORY_SEPARATOR . $avatar::PATHIMAGE . $entity . '/' . $media->getName());
        
        return $media;
    }
}