<?php

namespace Framework\Form\Constraint;

use Application\Repository\UserRepository;
use Framework\Form\Constraint\ConstraintInterface;

class Unique implements ConstraintInterface
{
    private string $entity;
    private string $field;

    public function __construct(string $entity, string $field)
    {
        $this->entity = $entity;
        $this->field = $field;

        $entityClass = 'Application\\Repository\\' . ucfirst($entity) . 'Repository';

        $this->entityClass = new $entityClass;
    }
    
    /**
     * verify
     *
     * @param  string $str
     * @return string|bool
     */
    public function verify(string $str)
    {
        if ($this->entityClass->isUniqueEntity($str)) {
            return "{$str} existe déjà";
        }

        return false;
    }
}
