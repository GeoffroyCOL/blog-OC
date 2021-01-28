<?php

namespace Application\Repository;

use Application\Repository\UserRepository;

class ReaderRepository extends UserRepository
{
    public function __construct()
    {
        parent::__construct();
    }
}
