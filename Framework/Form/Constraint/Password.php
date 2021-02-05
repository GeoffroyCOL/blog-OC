<?php

namespace Framework\Form\Constraint;

class Password
{
    private string $regex;
    private bool $isBlank;

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
        //Si aucune valeur est donnée et que le mdp peut être vide
        if ($this->isBlank && empty($password)) {
            return false;
        }

        if (! empty($password) && ! preg_match("#". $this->regex ."#", $password)) {
            return "Le mot de passe n'est pas au bon format.";
        }

        return false;
    }
}
