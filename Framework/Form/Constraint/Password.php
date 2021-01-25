<?php

namespace Framework\Form\Constraint;

class Password
{
    private string $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function verify($password)
    {
        if (! preg_match("#". $this->regex ."#", $password)) {
            return "Le mot de passe n'est pas au bon format.";
        }

        return false;

    }
}
