<?php

namespace Framework\Manager;

use Framework\Manager\ConnectManager;
use Framework\Manager\CreateEntityManager;

abstract class AbstractManager
{
    protected $bdd;
    protected $entity;

    public function __construct()
    {
        $this->setDb(ConnectManager::getInstance()->getPDOInstance());
        $this->entity = new CreateEntityManager;
    }

    /**
     * setDb
     *
     * @param  PDO $db
     *
     * @return void
     */
    public function setDb(\PDO $bdd)
    {
        $this->bdd = $bdd;
    }
}
