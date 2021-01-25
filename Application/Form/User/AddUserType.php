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
    private function initForm()
    {
        $this->addElement(new TextType([
            'label'         => 'pseudo',
            'help'          => 'Avec 6 caractères minimum',
            'constraints'   => [
                new Blank,
                new Length(4),
                new Unique('user', 'pseudo')
            ],
            /*'attr' => [
                'required'  => 'true'
            ]*/
        ]));
        $this->addElement(new EmailType([
            'label' => 'email',
            'constraints' => [
                new Email
            ],
            /*'attr' => [
                'required'  => 'true'
            ]*/
        ]));
        $this->addElement(new PasswordType([
            'label' => 'password',
            'help'  => 'Doit contenir au moins 6 caractères, un nombre et une majuscule',
            /*'constraints' => [
                new Password('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$')
            ],*/
            /*'attr' => [
                'required' => 'true'
            ]*/
        ]
        ));
        $this->addelement(new FileType([
            'label' => 'avatar',
            'help'  => 'Format png',
            'constraints' => [
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