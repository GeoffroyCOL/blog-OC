<?php

namespace Application\Service;

use Application\Entity\Media;

class UploadFileService
{
    private array $fileData = [];
    private string $entity;

    public function __construct(string $fileName, string $entity)
    {
        if (isset($_FILES[$fileName])) {
            $this->fileData = $_FILES[$fileName];
        }

        $this->entity = $entity;
    }
    
    /**
     * getData
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->fileData;
    }
    
    /**
     * isUpload
     *
     * @return bool
     */
    public function isUpload(): bool
    {
        return is_uploaded_file($this->fileData['tmp_name']);
    }
    
    /**
     * generateMedia
     *
     * @param  Media|null $media
     * @return Media
     */
    public function generateMedia(?Media $media = null): Media
    {
        if (! $media) {
            $media = new Media();
        }

        $media->setAlt('');
        $media->setExtension(explode('/', htmlentities($this->fileData['type']))[1]);

        $name = explode('.', htmlentities($this->fileData['name']))[0];
        $nameMedia = $name . '-' . uniqid() .'.'. $media->getExtension();
        $media->setName($nameMedia);

        $media->setUrl(DIRECTORY_SEPARATOR . 'public/img/' . $this->entity . DIRECTORY_SEPARATOR . $media->getName());

        return $media;
    }

    /**
     * moveFile - Déplace le fichier dans le réportoire voulu
     *
     * @param  string $destination
     * @return void
     */
    public function moveFile(string $destination): void
    {
        move_uploaded_file($this->fileData['tmp_name'], filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . DIRECTORY_SEPARATOR . 'public/img/' . $this->entity . '/' . $destination);
    }
    
    /**
     * deleteFile
     *
     * Supprime le fichier stocké dans le dossier img
     *
     * @param  string $url
     * @return void
     */
    public function deleteFile(string $url): void
    {
        unlink(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . $url);
    }
}
