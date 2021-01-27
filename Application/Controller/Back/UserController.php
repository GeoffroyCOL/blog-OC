<?php

namespace Application\Controller\Back;

use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;

class UserController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        $this->userService = new UserService;
    }
    
    /**
     * profil
     * 
     * @Route(path="/admin/profil", name="profil")
     *
     * @return Response
     */
    public function profil(): Response
    {
        return $this->render('back/user/profil.php');
    }
}
