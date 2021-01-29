<?php

namespace Framework\Session;

use Framework\Session\Session;

class MessageFlash
{
    private Session $session;
    private array $messages = [];
    private string $sessionKey = 'flash';

    public function __construct()
    {
        $this->session = new Session;
    }
    
    /**
     * add
     *
     * @param  string $status
     * @param  string $message
     * @return void
     */
    public function add(string $status, string $message)
    {
        $flash = $this->session->get($this->sessionKey, []);
        $flash[$this->sessionKey][$status] = $message;
        $this->session->set($this->sessionKey, $flash);
    }
    
    /**
     * ge
     *
     * @param  string $type
     * @return string|null
     */
    public function get(string $type): ?array
    {
        if (empty($this->messages)) {
            $this->messages = $this->session->get($this->sessionKey, []);
            $this->session->delete($this->sessionKey);
        }

        if (array_key_exists($type, $this->messages)) {
            //var_dump($this->messages[$type]);
            return $this->messages[$type];
        }

        return null;
    }
}