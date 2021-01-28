<?php

namespace Application\Repository;

use Application\Repository\UserRepository;

class AdminRepository extends UserRepository
{
    public function __construct()
    {
        parent::__construct();
    }
}