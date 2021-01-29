<?php

namespace Application\Controller\Front;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Framework\Error\LoginException;
use Application\Service\LoginService;

class LoginController extends AbstractController
{
    private LoginService $loginService;
    private Request $request;

    public function __construct()
    {
        parent::__construct();

        $this->loginService = new LoginService;
        $this->request = new Request;
    }
    
    /**
     * login
     *
     * @Route(path="/connexion", name="login")
     *
     * @return Response
     */
    public function login(): Response
    {
        $messageError = '';

        try {
            if ($this->request->method() === 'POST') {
                $pseudo = $this->request->postData('pseudo');
                $password = $this->request->postData('password');

                if (empty($pseudo) || empty($password)) {
                    throw new \RuntimeException("Problème lors de la connexion", 400);
                }

                $this->loginService->login($pseudo, $password);
                $this->addFlash('success', "Bienvenue {$pseudo}");
                $this->redirection('/admin/profil');
            }
        } catch (\RuntimeException | LoginException $e) {
            $messageError = $e->getMessage();
        }
        
        return $this->render('front/user/login.php', [
            'messageError' => $messageError
        ]);
    }

    /**
     * login
     *
     * @Route(path="/deconnexion", name="logout")
     *
     * @return Response
     */
    public function logout(): Response
    {
        $this->loginService->logout();
        $this->addFlash('success', "Au revoir");
        $this->redirection('/');
    }
}
