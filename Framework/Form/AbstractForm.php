<?php

/**
 * Permet de générer le formulaire et de traiter les données également
 */

namespace Framework\Form;

use Framework\HTTP\Request;

abstract class AbstractForm
{
    protected string $entity;
    protected $object;
    protected array $elements;
    protected Request $request;
    protected array $errors = [];

    public function __construct($object = null)
    {
        $this->request = new Request;
        $this->object = $object; //si on ajout ou modifie une entité
    }

    /**
     * Get the value of entity
     *
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * Set the value of entity
     *
     * @param  string $entity
     * @return  self
     */
    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }
    
    /**
     * createView
     *
     * Affiche le formulaire pour la vue
     *
     * @return string
     */
    public function createView(): string
    {
        $code = '<form enctype="multipart/form-data" method="POST">';
        foreach ($this->elements as $element) {
            $code .= $element->get();
        }
        $code .= '</form>';
        return $code;
    }
    
    /**
     * addElement
     *
     * Ajoute les différents type pour les formulaires
     *
     * @param  mixed $element
     * @return void
     */
    public function addElement($element): void
    {
        $this->elements[] = $element;
    }
    
    /**
     * getData
     *
     * Retourne l'entité avec les données fournit pat le formulaire
     */
    public function getData()
    {
        return isset($this->object) ? $this->getDataIsObject() : $this->getDataIsNotObject();
    }
    
    /**
     * getDataIsNotObject
     *
     * Renvoie un object pour un ajout
     */
    private function getDataIsNotObject()
    {
        $dataEntity = [];

        foreach ($this->elements as $element) {
            if (method_exists($element, 'getData')) {
                $label = $element->getData()['label'];
                if ($this->request->postExists($label)) {
                    $dataEntity[$label] = $this->request->postData($label);

                    //Si la donnée est une entité
                    if (class_exists("Application\\Entity\\" . ucfirst($label))) {
                        $respository = "Application\\Repository\\". ucfirst($label) . "Repository";
                        $dataEntity[$label] = (new $respository)->find((int) $this->request->postData($label));
                    }
                }
            }
        }

        $entity = new $this->entity();
        $entity->hydrate($dataEntity);

        return $entity;
    }
    
    /**
     * getDataIsObject
     *
     * Retourn objet modifié
     */
    private function getDataIsObject()
    {
        foreach ($this->elements as $element) {
            if (method_exists($element, 'getData')) {
                $label = $element->getData()['label'];
                if (! empty($this->request->postData($label))) {
                    $method = 'set'.ucfirst($label);
                    if (class_exists("Application\\Entity\\" . ucfirst($label))) {
                        $respository = "Application\\Repository\\". ucfirst($label) . "Repository";
                        $this->object->$method((new $respository)->find((int) $this->request->postData($label)));
                    }
                    
                    if (! class_exists("Application\\Entity\\" . ucfirst($label))) {
                        $this->object->$method($this->request->postData($label));
                    }
                }
            }
        }

        return $this->object;
    }
    
    /**
     * isValid
     *
     * Vérifie les données du formuliare selon la contrinte du champs
     *
     * @return bool
     */
    public function isValid(): bool
    {
        foreach ($this->elements as $element) {
            if (method_exists($element, 'getData')) {

                //Si le champs a une clé translate
                if (array_key_exists('translate', $element->getData())) {
                    $translate = $element->getData()['translate'];
                }

                //get->getData() récupère les données instancier lors de la création du formulaire
                $label = $element->getData()['label'];

                if (array_key_exists('constraints', $element->getData())) {
                    foreach ($element->getData()['constraints'] as $constraint) {
                        $result = $constraint->verify($this->request->postData($label));
                        if ($result) {
                            $title = isset($translate) ? $translate: $label;

                            $this->errors[$title][] = $result;
                        }
                    }
                }
            }
        }

        return empty($this->errors) ? true : false;
    }
    
    /**
     * getAllErrors
     *
     * @return array
     */
    public function getAllErrors(): array
    {
        return $this->errors;
    }
}
