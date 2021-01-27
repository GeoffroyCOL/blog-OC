<?php

namespace Application\Controller\Back;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;
use Application\Form\User\EditUserType;

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
     * profil
     * 
     * @Route(path="/admin/profil", name="profil")
     *
     * @return Response
     */
    public function profil(): Response
    {
        $this->isAccess();

        return $this->render('back/user/profil.php', [
            'user' => $this->getUser()
        ]);
    }
    
    /**
     * editProfil
     * 
     * @Route(path="/admin/edit/profil", name="profil")
     *
     * @param  mixed $ident
     * @return void
     */
    public function editProfil(): Response
    {
        $this->isAccess();

        $user = $this->getUser();

        $form = $this->createForm(EditUserType::class, $user);
        if ($this->request->method() === 'POST' && $form->isValid()) {
            $this->userService->edit($form->getData());
            $this->redirection('/admin/profil');
        }

        return $this->render('back/user/edit.php', [
            'form' => $form->createView()
        ]);
    }
}
