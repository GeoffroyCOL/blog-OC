<?php

namespace Framework\Manager;

class ConnectManager
{
    private static $instance = null;
    private $PDOInstance = null;

    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_HOST = 'localhost';
    const DB_NAME = 'blog';

    public function __construct()
    {
        $this->connectDataBase();
    }

    public function connectDataBase()
    {
        $options = [
            \PDO::ATTR_ERRMODE      => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_EMPTY_STRING,
        ];

        try {
            $this->PDOInstance = new \PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8', self::DB_USER, self::DB_PASSWORD, $options);
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
            self::$instance = new ConnectManager();
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