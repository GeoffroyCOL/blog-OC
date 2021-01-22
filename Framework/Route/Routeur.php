<?php

/**
 * Cette class permet de récupérer les différents routes se trouvant dans les différents controller et de vérifier que la route fournit existe
 */

namespace Framework\Route;

use Framework\File;
use Framework\Route\Route;

use Framework\App\ComponentFramework;

use Framework\Error\NotFoundException;
use Framework\Annotation\AnnotationFactory;

class Routeur
{
    private array $ListRoutes = [];

    public function __construct(string $nameComponent)
    {
        $listAnnotations = (AnnotationFactory::getClassAnnotation('RouteAnnotation', $nameComponent))->getListAnnotation();

        //Récupération des routes contenues dans les class Controller
        foreach($listAnnotations as $annotation) {
            $this->ListRoutes[] = new Route($annotation);
        }
    }
    
    /**
     * getMatchRoute - Vérifie que la route demandée existe
     *
     * @param  array $url
     * @return Route
     */
    public function getMatchRoute(array $url): Route
    {
        foreach($this->ListRoutes as $route) {
            //Vérifie que la route existe
            if (preg_match('#^' . $route->getPath() . '$#', $url["path"])) {
                return $route;
            }
        }

        throw new NotFoundException("La route demandée n'existe pas", 404);
    }

    /**
     * Récupère le nom du component de l'application : Front ou Back
     *
     * @param  string $nameComponent
     * @return  self
     */ 
    public function setNameComponent(string $nameComponent): self
    {
        $this->nameComponent = $nameComponent;

        return $this;
    }
}