<?php

namespace Framework\Form\Constraint;

class email
{
    public function verify(string $email)
    {
        if (! preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
            return "L'adresse email renseigné n'est pas au bon format.";
        }

        return false;
    }
}
