<?php

namespace Framework;

use Framework\Page;
use Framework\HTTP\Response;

abstract class AbstractController
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
        $this->page = new Page();
    }

    public function render(string $template, array $args): Response
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
}