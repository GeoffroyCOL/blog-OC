<?php

namespace Application\Form\User;

use Framework\Form\AbstractForm;
use Framework\Form\Field\FileType;
use Framework\Form\Field\TextType;
use Framework\Form\Constraint\File;
use Framework\Form\Field\EmailType;
use Framework\Form\Constraint\Blank;
use Framework\Form\Constraint\Email;
use Framework\Form\Field\ButtonType;
use Framework\Form\Constraint\Length;
use Framework\Form\Constraint\Unique;
use Framework\Form\Field\PasswordType;
use Framework\Form\Constraint\Password;

class EditUserType extends AbstractForm
{
    public function __construct($object = null)
    {
        parent::__construct($object);

        $this->entity = 'Application\\Entity\\'.ucfirst($object->getRole());

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
        $this->addElement(new EmailType([
            'label'         => 'email',
            'translate'     => 'Adresse email',
            'value'         => $this->object->getEmail(),
            'constraints'   => [
                new Email
            ]
        ]));
        $this->addElement(new PasswordType(
            [
            'label'         => 'newPassword',
            'translate'     => 'Mot de passe',
            'constraints' => [
                new Password('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$', true)
            ]
        ]
        ));
        $this->addelement(new FileType([
            'label' => 'avatar',
            'constraints' => [
                new File([
                    'name'  => 'avatar',
                    'type'  => 'image/png',
                    'size'  => 1000000
                ])
            ],
        ]));
        $this->addElement(new ButtonType('Modifier'));
    }
}
