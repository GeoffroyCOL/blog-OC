<?php

/**
 * Récupère la request pour afficher la réponse
 * Vérifie si la route demandée existe
 */

namespace Framework\App;

use Framework\UserConnect;
use Framework\Route\Routeur;
use Framework\Error\NotFoundException;
use Framework\Error\NotAccessException;
use Framework\HTTP\Request;
use Framework\HTTP\Response;

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
        $this->routeur = new Routeur($this->nameComponent);
    }
    
    /**
     * run
     * Permet de lancer l'application
     *
     * @return void
     */
    public function run()
    {
        try {
            //Récupérer la route renvoyée par la classe Routeur
            $this->routeur->setNameComponent($this->nameComponent);
            $route = $this->routeur->getMatchRoute($this->request->requestURI());

            //Récupère le controller et utilise la méthode associée
            $controllerRoute = $route->getController();
            $methodRoute = $route->getMethod();
            $controller = new $controllerRoute();
            $response = $route->getParam() !== null ? $controller->$methodRoute(basename($this->request->requestURI()['path'])) : $controller->$methodRoute();

            //Retourne la page demandée
            $response->send($this->nameComponent);
        } catch (NotFoundException | NotAccessException $e) {
            $this->response->redirectError($e->getCode());
        }
    }
}
