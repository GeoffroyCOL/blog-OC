<?php

namespace Framework\App;

use Framework\Route\Routeur;
use Framework\Error\NotFoundException;
use Framework\HTTP\{Request, Response};

abstract class AbstractFramework
{
    protected $request;
    protected $response;
    protected $routeur;
    protected string $nameComponent = '';

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        //$this->routeur = new Routeur($this->nameComponent);
    }
    
    /**
     * run
     * Permet de lancer l'application
     *
     * @return void
     */
    public function run()
    {
        //try {
            //Récupérer la route renvoyer par la class Routeur
            //$this->routeur->setNameComponent($this->nameComponent);
            //$route = $this->routeur->getMatchRoute($this->request->requestURI());

            //Je récupère le controller, je l'instancie et utilise la méthode
            //$controllerRoute = $route->getController();
            //$methodRoute = $route->getMethod();

            ///$controller = new $controllerRoute();
            //$response = $controller->$methodRoute();

            //$response->send($this->nameComponent);
        //} catch(NotFoundException $e) {
            //$this->response->redirect404();
        //}
    }
}