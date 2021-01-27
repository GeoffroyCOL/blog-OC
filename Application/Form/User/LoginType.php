<?php

namespace Application\Form\User;

use Application\Entity\Reader;
use Framework\Form\AbstractForm;
use Framework\Form\Field\FileType;
use Framework\Form\Field\TextType;
use Framework\Form\Constraint\Blank;
use Framework\Form\Field\ButtonType;
use Framework\Form\Constraint\Length;
use Framework\Form\Constraint\Unique;
use Framework\Form\Field\PasswordType;
use Framework\Form\Constraint\Password;

class LoginType extends AbstractForm
{
    public function __construct()
    {
        $this->entity = User::class;

        $this->initForm();

        parent::__construct();
    }
    
    /**
     * initForm
     * 
     * Ajoute les différents éléments pour le formulaire
     *
     * @return void
     */
    private function initForm()
    {
        $this->addElement(new TextType([
            'label'         => 'pseudo',
            'constraints'   => [
                new Blank,
                new Length(4),
                new Unique('user', 'pseudo')
            ],
            'attr' => [
                'required'  => 'true'
            ]
        ]));
        $this->addElement(new PasswordType([
            'label' => 'password',
            /*'constraints' => [
                new Password('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$')
            ],*/
            'attr' => [
                'required' => 'true'
            ]
        ]
        ));
        $this->addElement(new ButtonType('Connexion'));
    }
}