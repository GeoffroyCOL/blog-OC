<?php

namespace Framework\Manager;

class EntityManager
{
    /**
     * hydrate
     *
     * @param  array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}