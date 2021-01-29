<?php

namespace Application\Controller\Back;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;
use Application\Form\User\EditUserType;
use Framework\Error\NotFoundEntityException;

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
     * @Route(path="/admin/edit/profil", name="edit.profil")
     *
     * @param  mixed $ident
     * @return Response
     */
    public function editProfil(): Response
    {
        $this->isAccess();

        $user = $this->getUser();

        $form = $this->createForm(EditUserType::class, $user);
        if ($this->request->method() === 'POST' && $form->isValid()) {
            $this->userService->edit($form->getData());
            $this->addFlash('succes', 'Votre profil à bien été modifié');
            $this->redirection('/admin/profil');
        }

        return $this->render('back/user/edit.php', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * deleteProfil
     *
     * @Route(path="/admin/delete/profil", name="delete.profil")
     *
     * @return Response
     */
    public function deleteProfil(): Response
    {
        $this->isAccess();
        $user = $this->getUser();

        //Empêche que l'admin supprime son compte par erreur
        if ($user->getRole() !== 'reader') {
            $this->redirection('/admin/profil');
        }
        
        $this->userService->delete($user);
        $this->addFlash("succes", "Votre compte à bien été supprimé a bien été supprimée.");
        $this->redirection('/');
    }
    
    /**
     * listUsers
     *
     * @Route(path="/admin/users", name="liste.users")
     *
     * @return Response
     */
    public function listUsers(): Response
    {
        $this->isAccess('admin');

        return $this->render('back/user/listUsers.php', [
            'users' => $this->userService->getAll()
        ]);
    }
    
    /**
     * showUser
     *
     * @Route(path="/admin/user/{id}", name="show.user", requirement="[0-9]")
     *
     * @param  int $id
     * @return Response
     */
    public function showUser($id): Response
    {
        try {
            $this->isAccess('admin');

            $user = $this->userService->getUser($id);
        } catch (NotFoundEntityException $e) {
            $messageErrors = $e->getMessage();
        }

        return $this->render('back/user/showUser.php', [
            'user'          => $user ?? null,
            'messageError'  => $messageErrors ?? ''
        ]);
    }
    
    /**
     * valideUser
     *
     * @Route(path="/admin/valide/user/{id}", name="valide.user", requirement="[0-9]")
     *
     * @param  int $id
     * @return Response
     */
    public function valideUser($ident)
    {
        $this->isAccess('admin');
        $this->userService->valide($ident);
        $this->addFlash("succes", "La demande de l'utilisateur '{$user->getPseudo()}' a bien été validé.");

        $this->redirection('/admin/users');
    }
}
