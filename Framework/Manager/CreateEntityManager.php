<?php

//Permet de instancier une entité

namespace Framework\Manager;

class CreateEntityManager
{
    private array $data;
    private string $entity;
    private array $properties = [];
    
    /**
     * generateEntity
     *
     * @param  array $data
     * @param  strign $entity
     */
    public function generateEntity(array $data, string $entity)
    {
        //Je récupère les données envoyé depuis le repository et l'entity
        $this->data = $data;
        $this->entity = 'Application\\Entity\\' . $entity;

        //Récupère les propriétés de l'entity ainsi que leur type
        $this->setTypeForProperties();

        //Génère l'entité et l'hydrate
        return $this->createEntity();
    }
    
    /**
     * setTypeForProperties
     * 
     * Récupère le type des propriétés pour les lister dans un tableau
     * 
     * @return void
     */
    private function setTypeForProperties(): void
    {
        $reflection = new \ReflectionClass($this->entity);

        foreach($reflection->getProperties() as $property) {
            $this->properties[$property->getName()] = $reflection->getProperty($property->getName())->getType()->getName();
        }
    }
    
    /**
     * createEntity
     *
     * Permet de retourner un objet avec les données envoyées
     */
    private function createEntity()
    {
        foreach($this->properties as $property => $type) {
            //On vérifie que les type de chaque propriétés ne sont pas null et sont une class
            if (class_exists($type) && $this->data[$property] !== null) {
                //Si elle contient At alors on instancie DateTime 
                if (preg_match('#At#', $property)) {
                    $this->data[$property] = new \DateTime($this->data[$property]);
                } else { // Sinon on instancie la class et on remplace la valeur par l'aobjet
                    $classRepository = str_replace('Entity', 'Repository', $type.'Repository');
                    $this->data[$property] = (new $classRepository())->find((int) $this->data[$property]);
                }
            }
        }

        $entity = new $this->entity();
        $entity->hydrate($this->data, $this->entity);

        return $entity;
    }
}