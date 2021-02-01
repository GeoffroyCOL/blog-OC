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
     * @param  Media $media
     * @return Media
     */
    public function add(Media $media): Media
    {
        return $this->repository->persist($media);
    }
    
    /**
     * edit
     *
     * @param  Media $media
     * @return Media
     */
    public function edit(Media $media): Media
    {
        return $this->repository->edit($media);
    }
    
    /**
     * delete
     *
     * @param  Media $media
     * @return void
     */
    public function delete(Media $media): void
    {
        $this->repository->delete($media);
    }
}