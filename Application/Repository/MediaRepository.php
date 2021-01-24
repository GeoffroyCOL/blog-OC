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
}