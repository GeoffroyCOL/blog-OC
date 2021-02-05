<?php

namespace Framework\Session;

class Session
{
    private $arraySession;

    public function __construct()
    {
        $this->ensureStarted();

        $this->arraySession = &$_SESSION;
    }
    /**
     * ensureStarted
     *
     * Assure que la Session est démarrée
     *
     * @return void
     */
    private function ensureStarted()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * get
     *
     * @param  mixed $key
     * @param  string $default
     * @return void
     */
    public function get(string $key, $default = null)
    {
        if (array_key_exists($key, $this->arraySession)) {
            return $this->arraySession[$key];
        }

        return $default;
    }
    
    /**
     * set
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function set(string $key, $value): void
    {
        $this->arraySession[$key] = $value;
    }
    
    /**
     * delete
     *
     * @param  string $key
     * @return void
     */
    public function delete(string $key): void
    {
        unset($this->arraySession[$key]);
    }
}
