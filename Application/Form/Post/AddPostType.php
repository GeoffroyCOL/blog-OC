<?php

namespace Application\Form\Post;

use Application\Entity\Post;
use Framework\Form\AbstractForm;
use Framework\Form\Field\FileType;
use Framework\Form\Field\TextType;
use Framework\Form\Constraint\File;
use Framework\Form\Constraint\Blank;
use Framework\Form\Field\ButtonType;
use Framework\Form\Field\SelectType;
use Framework\Form\Constraint\Length;
use Framework\Form\Constraint\Unique;
use Framework\Form\Field\PasswordType;
use Framework\Form\Field\TextareaType;
use Framework\Form\Constraint\Password;

class AddPostType extends AbstractForm
{
    public function __construct()
    {
        $this->entity = Post::class;

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
            'label'         => 'title',
            'constraints'   => [
                new Blank,
                new Length(4),
                new Unique('user', 'title')
            ],
            'attr' => [
                'required'  => 'true'
            ]
        ]));
        $this->addElement(new TextareaType([
            'label' => 'content'
        ]));
        $this->addElement(new SelectType([
            'label' => 'category',
            'class' => 'category'
        ]));
        $this->addelement(new FileType([
            'label' => 'featured',
            'constraints' => [
                new File([
                    'name'  => 'featured',
                    'size'  => 1000000
                ])
            ],
        ]));
        $this->addElement(new ButtonType('Ajouter'));
    }
}
