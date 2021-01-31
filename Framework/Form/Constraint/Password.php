<?php

namespace Framework\Form\Constraint;

class Password
{
    private string $regex;    
    private bool $isBlanck;

    public function __construct(string $regex, bool $isBlank = false)
    {
        $this->regex = $regex;        
        $this->isBlank = $isBlank;
    }
    
    /**
     * verify
     *
     * @param  string $password
     * @return string|bool
     */
    public function verify($password)
    {
        if ($this->isBlank && ! preg_match("#". $this->regex ."#", $password)) {
            return "Le mot de passe n'est pas au bon format.";
        }

        return false;
    }
}
