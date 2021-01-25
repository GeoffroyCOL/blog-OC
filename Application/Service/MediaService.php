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
     * @return Media
     */
    public function add(array $data): Media
    {
        $avatar = new Media;

        //Récupère le nom du fichier téléchargé
        $fileName = $data['tmp_name'];

        $avatar->setAlt('avatar');
        $avatar->setExtension(explode('/', htmlentities($data['type']))[1]);

        $name = explode('.', htmlentities($data['name']))[0];
        $nameMedia = $name . '-' . uniqid() .'.'. $avatar->getExtension();
        $avatar->setName($nameMedia);

        $avatar->setUrl($avatar::PATHIMAGE . $avatar->getName());

        $media = $this->repository->persist($avatar);

        move_uploaded_file($fileName, filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . $avatar::PATHIMAGE . $avatar->getName());
        
        return $media;
    }
}