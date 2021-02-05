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
        parent::__construct();

        $this->entity = Post::class;

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
            'label'         => 'title',
            'translate'     => 'Titre de l\'article',
            'constraints'   => [
                new Blank,
                new Length(4),
                new Unique('post', 'title')
            ],
            'attr' => [
                'required'  => 'true'
            ]
        ]));
        $this->addElement(new TextareaType([
            'label'         => 'content',
            'translate'     => 'Contenue du post',
            'attr' => [
                'rows'      => 20
            ],
            'constraints'   => [
                new Blank,
                new Length(10)
            ],
        ]));
        $this->addElement(new SelectType([
            'label'     => 'category',
            'translate' => 'Catégorie',
            'class'     => 'category',
            'attr' => [
                'required'  => 'true'
            ],
            'constraints'   => [
                new Blank
            ],
        ]));
        $this->addelement(new FileType([
            'label'         => 'featured',
            'translate'     => 'Image à la une',
            'constraints'   => [
                new File([
                    'name'  => 'featured',
                    'size'  => 1000000
                ])
            ],
            'attr' => [
                'required'  => 'true'
            ]
        ]));
        $this->addElement(new ButtonType('Ajouter'));
    }
}
