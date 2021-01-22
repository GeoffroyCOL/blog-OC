<?php

namespace Framework\Route;

class Route
{
    private string $controller;
    private string $method;
    private string $path;
    private string $pathName;
    private string $param = "";
    private string $requirement = "";

    public function __construct(array $annotationRoute)
    {
        $paths = $this->generatePath($annotationRoute['annotation']);

        $this->controller = $annotationRoute['controller'];
        $this->requirement = isset($paths['requirement']) ? $paths['requirement'] : "";
        $this->method = $annotationRoute['method'];
        $this->path = preg_replace('#\/\{.+\}#', '/' . $this->requirement .'+', $paths['path']);
        $this->pathName = $paths['name'];
    }
    
    /**
     * generatePath
     *
     * @param  string $annotation
     * @return array
     */
    private function generatePath(string $annotation): array
    {
        $tabPath = [];

        $tabElementsAnnotation = explode(',', $annotation);

        foreach ($tabElementsAnnotation as $element) {
            //Si la route possède un paramètre
            if (preg_match('#\{(.+)\}#', $element, $result)) {
                $this->param = $result[1];
            }

            $listelement = explode('=', $element);
            $tabPath[trim($listelement[0])] = str_replace('"', '', $listelement[1]);
        }

        return $tabPath;
    }

    /**
     * Get the value of controller
     *
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @param  string $controller
     * @return  self
     */
    public function setController(string $controller): self
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @param  string $method
     * @return  self
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the value of path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @param  string $path
     * @return  self
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of pathName
     *
     * @return string
     */
    public function getPathName(): string
    {
        return $this->pathName;
    }

    /**
     * Set the value of pathName
     *
     * @param  string $pathName
     * @return  self
     */
    public function setPathName(string $pathName): self
    {
        $this->pathName = $pathName;

        return $this;
    }

    /**
     * Get the value of params
     * 
     * @return array
     */ 
    public function getParam(): string
    {
        return $this->param;
    }

    /**
     * Set the value of params
     *
     * @param  array $param
     * @return  self
     */ 
    public function setParam(string $param): self
    {
        $this->param = $param;

        return $this;
    }
}
