<?php

namespace Framework\App;

use Framework\HTTP\Request;
use Framework\Route\Routeur;

class FrontFramework extends AbstractFramework
{
    protected string $nameComponent = '';

    public function __construct()
    {
        $this->nameComponent = 'Front';

        parent::__construct();
    }
}