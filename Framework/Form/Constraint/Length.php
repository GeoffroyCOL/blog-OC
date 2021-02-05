<?php

namespace Framework\Form\Constraint;

use Framework\Form\Constraint\ConstraintInterface;

class length implements ConstraintInterface
{
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }
    
    /**
     * verify
     *
     * @param  string $data
     * @return string|bool
     */
    public function verify(string $data)
    {
        if (strlen($data) < $this->number) {
            return "Le nombre de caractère est insuffissant : " . strlen($data);
        }
    }
}
