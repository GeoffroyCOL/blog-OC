<?php

namespace Framework;

use Framework\Page;
use Framework\UserConnect;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\Form\AbstractForm;
use Framework\Error\NotAccessException;

abstract class AbstractController
{
    private Response $response;
    private Page $page;
    private Request $request;
    private UserConnect $userConnect;

    public function __construct()
    {
        $this->response = new Response;
        $this->page = new Page;
        $this->request = new Request;
        $this->userConnect = new UserConnect;
    }
    
    /**
     * render
     *
     * @param  string $template
     * @param  array|null $args
     * @return Response
     */
    public function render(string $template, ?array $args = []): Response
    {
        $fileTemplate = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Application/template/' . $template;
        if (! file_exists($fileTemplate)) {
            throw new \Exception("Le template ' {$template} ' demandé n'existe pas", 1);
        }

        $this->page->setContentFile($fileTemplate);
        $this->page->addParameters($args);

        $this->response->setPage($this->page);

        return $this->response;
    }
    
    /**
     * createForm
     *
     * @param  string $formType
     * @return AbstractForm
     */
    public function createForm(string $formType, $object = null): AbstractForm
    {
        return new $formType($object);
    }
    
    /**
     * redirection
     *
     * @param  string $path
     * @return Response
     */
    public function redirection(string $path): Response
    {
        return $this->response->redirect($path);
    }
    
    /**
     * getUser
     *
     * @return User
     */
    public function getUser()
    {
        return $this->userConnect->getUserConnect();
    }

    public function isAccess(?string $role = '')
    {
        $user = $this->getUser();

        if (! $user) {
            throw new NotAccessException("Vous n'avez pas accès à cette partie.", 403);
        }

        if ($user && ! preg_match('#'. $role .'#', $user->getRole())) {
            throw new NotAccessException("Vous n'avez pas les droits nécessaire pour accéder à cette partie.", 403);
        }
    }
}