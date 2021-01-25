<?php

namespace Framework\Form\Constraint;

class Blank
{
    public function verify(string $str)
    {
        if (empty($str)) {
            return "La valeur soumise est vide";
        }

        return false;
    }
}