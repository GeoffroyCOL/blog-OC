<?php

namespace Framework;

use Framework\Page;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\Form\AbstractForm;

abstract class AbstractController
{
    private Response $response;
    private Page $page;
    private Request $request;

    public function __construct()
    {
        $this->response = new Response;
        $this->page = new Page;
        $this->request = new Request;

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
    public function createForm(string $formType): AbstractForm
    {
        return new $formType();
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
        return $this->UserConnect->getUserConnect();
    }
}