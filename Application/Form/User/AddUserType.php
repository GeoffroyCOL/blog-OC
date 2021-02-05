<?php

namespace Application\Form\User;

use Application\Entity\Reader;
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

class AddUserType extends AbstractForm
{
    public function __construct()
    {
        $this->entity = Reader::class;

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
    private function initForm(): void
    {
        $this->addElement(new TextType([
            'label'         => 'pseudo',
            'help'          => 'Votre pseudo doit avoir 4 caractères au minimum.',
            'constraints'   => [
                new Blank,
                new Length(4),
                new Unique('user', 'pseudo')
            ],
            'attr' => [
                'required'  => 'true'
            ]
        ]));
        $this->addElement(new EmailType([
            'label'         => 'email',
            'translate'     => 'Adresse email',
            'constraints'   => [
                new Email
            ],
            'attr' => [
                'required'  => 'true'
            ]
        ]));
        $this->addElement(new PasswordType([
            'label'         => 'password',
            'translate'     => 'Mot de passe',
            'help'          => 'Votre mot de passe doit contenir au moins 6 caractères, un nombre et une majuscule',
            'constraints'   => [
                new Password('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$')
            ],
            'attr' => [
                'required' => 'true'
            ]
        ]));
        $this->addelement(new FileType([
            'label'         => 'avatar',
            'help'          => 'Non obligatoire, mais il doit être au format png.',
            'constraints'   => [
                new File([
                    'name'  => 'avatar',
                    'type'  => 'image/png',
                    'size'  => 1000000
                ])
            ],
        ]));
        $this->addElement(new ButtonType('Inscription'));
    }
}
