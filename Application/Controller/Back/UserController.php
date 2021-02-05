<?php

namespace Application\Controller\Back;

use Framework\Pagination;
use Framework\Email\Email;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\UserService;
use Application\Service\LoginService;
use Framework\Error\NotFoundException;
use Application\Form\User\EditUserType;
use Framework\Error\NotFoundEntityException;

class UserController extends AbstractController
{
    private UserService $userService;
    private Request $request;
    private Email $email;
    private Pagination $pagination;
    private LoginService $loginService;

    public function __construct()
    {
        parent::__construct();

        $this->userService = new UserService;
        $this->request = new Request;
        $this->email = new Email;
        $this->request = new Request;
        $this->pagination = new Pagination;
        $this->loginService = new LoginService;
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
            'user'  => $this->getUser(),
        ]);
    }
    
    /**
     * editProfil
     *
     * @Route(path="/admin/edit/profil", name="edit.profil")
     *
     * @return Response
     */
    public function editProfil(): Response
    {
        $this->isAccess();

        $user = $this->getUser();

        $form = $this->createForm(EditUserType::class, $user);
        if ($this->request->method() === 'POST' && $form->isValid()) {
            $this->userService->edit($form->getData());
            $this->addFlash('success', 'Votre profil à bien été modifié');
            $this->redirection('/admin/profil');
        }

        return $this->render('back/user/edit.php', [
            'form'          => $form->createView(),
            'formErrors'    => $form->getAllErrors()
        ]);
    }
    
    /**
     * deleteProfil - L'utilisateur supprime son profil
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
        $this->loginService->logout();
        $this->addFlash("success", "Votre compte à bien été supprimé.");
        $this->redirection('/');
    }

    /**
     * deleteUser - Pour que l'admin puisse supprimer un utilisateur si inscription non validé
     *
     * @Route(path="/admin/user/delete/{id}", name="delete.profil", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function deleteUser($ident): Response
    {
        try {
            $this->isAccess('admin');
            $user = $this->userService->getUser($ident);

            //Si admin, alors on ne supprime pas le compte
            if ($user->getRole() === 'admin') {
                $this->addFlash("error", "Ce compte ne peut pas être supprimé.");
            }

            $this->userService->delete($user);
            $this->email->sendNotValide($user);
            $this->addFlash("success", "Votre compte à bien été supprimé.");
        } catch (NotFoundEntityException $e) {
            $this->addFlash("error", $e->getMessage());
        } finally {
            $this->redirection('/admin/users');
        }
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
        
        $numberPostPerPage = 10;
        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;
        if ($page < 1) {
            throw new NotFoundException("Pas de catégories pour la page demandée", 404);
        }

        $users = $this->userService->getAll(($page - 1), $numberPostPerPage);

        if (empty($users)) {
            $this->addFlash('info', "Pour la page {$page}, pas d'utilisateurs à afficher.");
        }

        $this->pagination->setParams($numberPostPerPage, $page, $this->userService->numberUser(), '/admin/users');

        return $this->render('back/user/listUsers.php', [
            'users'             => $users,
            'pageMenu'          => 'users',
            'pagination'        => $this->pagination->generateHTML(),
            'numeroPage'        => $page,
            'numberPostPerPage' => $numberPostPerPage,
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

            return $this->render('back/user/showUser.php', [
                'user'      => $user,
                'pageMenu'  => 'users'
            ]);
        } catch (NotFoundEntityException $e) {
            $this->addFlash("error", $e->getMessage());
            $this->redirection('/admin/users');
        }
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
        try {
            $this->isAccess('admin');
            $this->userService->valide($ident);

            $user = $this->userService->getUser($ident);
            $this->email->sendValide($user);
            $this->addFlash("success", "L'utilisateur a bien été validé.");
        } catch (NotFoundException $e) {
            $this->addFlash("error", $e->getMessage());
        }

        $this->redirection('/admin/users');
    }
}
