<?php

namespace Framework\Session;

class Session 
{    
    
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
        $this->ensureStarted();

        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
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
        $this->ensureStarted();

        $_SESSION[$key] = $value;
    }
    
    /**
     * delete
     *
     * @param  string $key
     * @return void
     */
    public function delete(string $key): void 
    {
        $this->ensureStarted();
        
        unset($_SESSION[$key]);
    }
}