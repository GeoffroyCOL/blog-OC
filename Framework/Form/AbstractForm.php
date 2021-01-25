<?php

namespace Framework\Form;

use Framework\HTTP\Request;

abstract class AbstractForm
{
    protected string $entity;
    protected array $elements;
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request;
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
    public function addElement($element)
    {
        $this->elements[] = $element;
    }
    
    /**
     * getData
     * 
     * Retourne l'entité avec les données fournit pat le formulaire
     *
     * @return void
     */
    public function getData()
    {
        $dataEntity = [];

        foreach($this->elements as $element) {
            if (method_exists($element, 'getData')) {
                $label = $element->getData()['label'];

                if ($this->request->postExists($label)) {
                    $dataEntity[$label] = $this->request->postData($label);
                }
            }
        }

        $entity = new $this->entity();
        $entity->hydrate($dataEntity);

        return $entity;
    }
    
    /**
     * isValid
     * 
     * Si la donneés a des constraints alors cette méthode vérifie si elles sont valident
     *
     * @return bool
     */
    public function isValid(): bool
    {
        $errors = [];

        foreach($this->elements as $element) {
            if (method_exists($element, 'getData')) {
                //get->getData() récupère les données instancier lors de la création du formulaire
                $label = $element->getData()['label'];

                if (array_key_exists('constraints', $element->getData())) {
                    foreach ($element->getData()['constraints'] as $constraint) {
                        //Effectue les vérifications
                        $result = $constraint->verify($this->request->postData($label));
                        if ($result) {
                            $errors[$label][] = $result;
                        }
                    }
                }
            }
        }

        var_dump($errors);

        return empty($errors) ? true : false;
    }
}
