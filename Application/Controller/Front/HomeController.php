<?php

namespace Application\Controller\Front;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;
use Application\Service\ContactService;

class HomeController extends AbstractController
{
    private UserService $userService;
    private Request $request;
    private ContactService $contactService;

    public function __construct()
    {
        parent::__construct();

        $this->userService = new UserService;
        $this->request = new Request;
        $this->contactService = new ContactService;
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
        try {
            if ($this->request->method() === 'POST') {
                $this->contactService->sendEmailContact();
                $this->addFlash('success', "Votre message à bien été envoyé");
            }
        } catch (\Exception $e) {
            $this->addFlash('info', $e->getMessage());
        }

        return $this->render('front/home/home.php', [
            'pageMenu'  => 'home',
            'pageTitle' => 'Développeur WEB'
        ]);
    }
}
