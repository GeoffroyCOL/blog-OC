<?php

/**
 * Pour l'application côté back
 */

namespace Framework\App;

use Framework\HTTP\Request;
use Framework\Route\Routeur;

class BackFramework extends AbstractFramework
{
    protected string $nameComponent = '';

    public function __construct()
    {
        $this->nameComponent = 'Back';

        parent::__construct();
    }
}
