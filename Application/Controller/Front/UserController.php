<?php

namespace Application\Controller\Front;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;
use Application\Form\User\AddUserType;

class UserController extends AbstractController
{
    private UserService $userService;
    private Request $request;

    public function __construct()
    {
        parent::__construct();

        $this->userService = new UserService;
        $this->request = new Request;
    }
    
    /**
     * register
     *
     * @Route(path="/inscription", name="register")
     *
     * @return Response
     */
    public function register(): Response
    {
        $form = $this->createForm(AddUserType::class);

        if ($this->request->method() === 'POST' && $form->isValid()) {
            $this->userService->add($form->getData());
            $this->redirection('/inscription');
        }

        return $this->render('front/user/register.php', [
            'form' => $form->createView()
        ]);
    }
}
