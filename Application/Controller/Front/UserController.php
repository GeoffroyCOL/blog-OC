<?php

namespace Application\Controller\Front;

use Framework\Email\Email;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;
use Application\Form\User\AddUserType;

class UserController extends AbstractController
{
    private UserService $userService;
    private Request $request;
    private Email $email;

    public function __construct()
    {
        parent::__construct();

        $this->userService = new UserService;
        $this->request = new Request;
        $this->email = new Email;
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
            $this->email->sendInscription($form->getData());
            $this->addFlash("success", "Votre demande a bien été enregistrée. L'administrateur validera votre inscription.");
            $this->redirection('/');
        }

        return $this->render('front/user/register.php', [
            'form' => $form->createView()
        ]);
    }
}
