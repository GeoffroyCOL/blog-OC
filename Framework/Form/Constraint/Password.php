<?php

namespace Framework\Form\Constraint;

class Password
{
    private string $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }
    
    /**
     * verify
     *
     * @param  string $password
     * @return string|bool
     */
    public function verify($password)
    {
        if (! preg_match("#". $this->regex ."#", $password)) {
            return "Le mot de passe n'est pas au bon format.";
        }

        return false;
    }
}
