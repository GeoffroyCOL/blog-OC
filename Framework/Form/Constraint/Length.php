<?php

namespace Framework\Form\Constraint;

class length
{
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function verify($data)
    {
        if (strlen($data) < $this->number) {
            return "La nombre de caractère est insuffissant : " . strlen($data);
        }
    }
}