<?php

namespace Framework\Manager;

class EntityManager
{
    public function hydrate(array $datas, string $class)
    {
        foreach($datas as $key => $data) {
            $method = 'set'.ucfirst($key);
            if (method_exists($class, $method)) {
                $this->$method($data);
            }
        }
    }
}