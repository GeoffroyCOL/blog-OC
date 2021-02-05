<?php

namespace Application\Controller\Front;

use Framework\AbstractController;

class ErrorController extends AbstractController
{    
    /**
     * error404
     * 
     * @Route(path="/404", name="not-found")
     *
     * @return void
     */
    public function error404()
    {
        return $this->render('/errors/404.php');
    }

    /**
     * error403
     * 
     * @Route(path="/403", name="not-forbidden")
     *
     * @return void
     */
    public function error403()
    {
        return $this->render('/errors/403.php');
    }
}