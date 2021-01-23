<?php

namespace Framework\Manager;

class ConnectManager
{
    private static $instance = null;
    private $PDOInstance = null;
    private $nameDataBase;

    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_HOST = 'localhost';
    const DB_NAME = 'blog';

    public function connectDataBase()
    {
        try {
            $this->PDOInstance = new \PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8', self::DB_USER, self::DB_PASSWORD);
            $this->PDOInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    
    /**
     * getInstance
     *
     * @return Config
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ConnectBDD();
        }

        return self::$instance;
    }

    /**
     * getPDOInstance
     *
     * @return PDO
     */
    public function getPDOInstance()
    {
        return $this->PDOInstance;
    }
}