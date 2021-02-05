<?php

/**
 * Récupère les annotation @route des controllers
 */

namespace Framework\Annotation;

use Framework\File;

class RouteAnnotation implements AnnotationInterface
{
    private array $listFiles = [];
    private array $listAnnotation = [];

    const ANNOTATION = '@Route';

    public function __construct(?string $component = "")
    {
        //$component => front ou back pour faire la recherche de fichier soit dans le dossier back ou soir le dossier front
        $this->listFiles = (new File('Application/Controller/' . $component))->getListFile();
        $this->setAnnotationsInfile();
    }
    
    /**
     * setAnnotationsInfile
     *
     * @return array
     */
    public function setAnnotationsInfile()
    {
        foreach ($this->listFiles as $file) {
            if (class_exists($file)) {
                $reflectionClass = new \ReflectionClass($file);

                //Récupère la liste des méthode de chaque fichier ainsi que ce qui se trouve dans l'annotation @Route
                foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                    if (! $method->isConstructor() && preg_match('/'.self::ANNOTATION.'\(([^\(\)]+)\)/', $method->getDocComment(), $result)) {
                        $this->listAnnotation[] = [
                            'controller'    => $file,
                            'method'        => $method->getName(),
                            'annotation'    => $result[1]
                        ];
                    }
                }
            }
        }
    }
    
    /**
     * getListAnnotation
     *
     * @return array
     */
    public function getListAnnotation(): array
    {
        return $this->listAnnotation;
    }
}
