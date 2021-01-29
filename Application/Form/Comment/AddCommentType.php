<?php

namespace Application\Form\Comment;

use Application\Entity\Comment;
use Framework\Form\AbstractForm;
use Framework\Form\Field\TextType;
use Framework\Form\Constraint\Blank;
use Framework\Form\Field\ButtonType;
use Framework\Form\Field\TextareaType;

class AddCommentType extends AbstractForm
{
    public function __construct()
    {
        $this->entity = Comment::class;

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
        $this->addElement(new TextareaType([
            'label'         => 'content',
            'translate'     => 'Votre commentaire',
            'attr' => [
                'required'  => 'true'
            ],
            'constraints'   => [
                new Blank
            ],
        ]));
        $this->addElement(new ButtonType('Ajouter'));
    }
}
