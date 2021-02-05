<?php

namespace Framework\Form\Constraint;

use Framework\Form\Constraint\ConstraintInterface;

class Blank implements ConstraintInterface
{
    /**
     * verify
     *
     * @param  string $str
     * @return string|bool
     */
    public function verify(string $str)
    {
        if (empty($str)) {
            return "La valeur est vide";
        }
    }
}
