<?php

namespace Application\Repository;

use Application\Entity\Media;
use Framework\Manager\AbstractManager;

class MediaRepository extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * find
     *
     * @param  int $ident
     * @return Media
     */
    public function find(int $ident): Media
    {
        $request = $this->bdd->prepare('SELECT id, name, alt, extension FROM media WHERE id = :id');

        $request->bindValue(':id', $ident, \PDO::PARAM_INT);
        $request->execute();

        return $request->fetchObject('Application\\Entity\\Media');
    }
    
    /**
     * persist
     *
     * @param  Media $media
     * @return Media
     */
    public function persist(Media $media): Media
    {
        $request = $this->bdd->prepare('INSERT INTO media(name, extension, alt, url) VALUES(:name, :extension, :alt, :url) ');

        $request->bindValue(':name', $media->getName(), \PDO::PARAM_STR);
        $request->bindValue(':extension', $media->getExtension(), \PDO::PARAM_STR);
        $request->bindValue(':alt', $media->getAlt(), \PDO::PARAM_STR);
        $request->bindValue(':url', $media->getUrl(), \PDO::PARAM_STR);

        $request->execute();

        //Ajout à l'aobjet Media le dernière id enregistrer
        $media->setId($this->bdd->lastInsertId());

        return $media;
    }
}