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
    public function add(Media $media): Media
    {
        return $this->repository->persist($media);
    }
    
    /**
     * edit
     *
     * @param  Media $avatar
     * @param  array $data
     * @param  string $entity
     * @return void
     */
    public function edit(Media $media)
    {
        return $this->repository->edit($media);
    }
    
    /**
     * delete
     *
     * @param  Media $media
     * @return void
     */
    public function delete(Media $media)
    {
        $this->repository->delete($media);
    }
}