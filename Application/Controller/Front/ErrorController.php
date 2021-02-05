<?php

namespace Application\Controller\Front;

use Framework\HTTP\Response;
use Framework\AbstractController;

class ErrorController extends AbstractController
{    
    /**
     * error404
     * 
     * @Route(path="/404", name="not-found")
     *
     * @return Response
     */
    public function error404(): Response
    {
        return $this->render('/errors/404.php');
    }

    /**
     * error403
     * 
     * @Route(path="/403", name="not-forbidden")
     *
     * @return Response
     */
    public function error403(): Response
    {
        return $this->render('/errors/403.php');
    }
}