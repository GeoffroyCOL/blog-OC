<?php

namespace Application\Controller\Front;

use Framework\HTTP\Response;
use Framework\AbstractController;

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * index
     *
     * @Route(path="/", name="home")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('front/home/home.php', []);
    }
}
