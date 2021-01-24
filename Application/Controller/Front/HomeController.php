<?php

namespace Application\Controller\Front;

use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;

class HomeController extends AbstractController
{
    private UserService $userService;

    public function __construct()
    {
        parent::__construct();

        $this->userService = new UserService;
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
        $user = $this->userService->getUser(1);

        var_dump($user);

        return $this->render('front/home/home.php', []);
    }
}
