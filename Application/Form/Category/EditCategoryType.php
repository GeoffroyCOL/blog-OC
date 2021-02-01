<?php

namespace Application\Form\Category;

use Application\Entity\Category;
use Framework\Form\AbstractForm;
use Framework\Form\Field\TextType;
use Framework\Form\Constraint\Blank;
use Framework\Form\Field\ButtonType;
use Framework\Form\Constraint\Length;
use Framework\Form\Constraint\Unique;
use Framework\Form\Field\PasswordType;
use Framework\Form\Constraint\Password;

class EditCategoryType extends AbstractForm
{
    public function __construct($object = null)
    {
        parent::__construct($object);

        $this->entity = Category::class;

        $this->initForm();
    }
    
    /**
     * initForm
     *
     * Ajoute les différents éléments pour le formulaire
     *
     * @return void
     */
    private function initForm(): void
    {
        $this->addElement(new TextType([
            'label'         => 'name',
            'translate'     => 'Nom de la catégorie',
            'value'         => $this->object->getName(),
            'help'          => 'Avec 3 caractères minimum',
            'constraints'   => [
                new Blank,
                new Length(3)
            ],
            'attr' => [
                'required'  => 'true'
            ]
        ]));
        $this->addElement(new ButtonType('Modifier'));
    }
}
