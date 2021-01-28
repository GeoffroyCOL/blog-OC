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
     * generateMedia
     *
     * @return Media
     */
    public function generateMedia(): Media
    {
        $image = new Media();

        $image->setAlt('');
        $image->setExtension(explode('/', htmlentities($this->fileData['type']))[1]);

        $name = explode('.', htmlentities($this->fileData['name']))[0];
        $nameMedia = $name . '-' . uniqid() .'.'. $image->getExtension();
        $image->setName($nameMedia);

        $image->setUrl(DIRECTORY_SEPARATOR . $image::PATHIMAGE . $this->entity . DIRECTORY_SEPARATOR . $image->getName());

        return $image;
    }

    /**
     * moveFile
     *
     * @param  string $fileName
     * @param  string $destination
     * @return void
     */
    public function moveFile(string $destination)
    {
        move_uploaded_file($this->fileData['tmp_name'], filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . DIRECTORY_SEPARATOR . 'public/img/' . $this->entity . '/' . $destination);
    }
}