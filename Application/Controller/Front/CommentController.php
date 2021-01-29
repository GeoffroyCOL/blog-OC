<?php

namespace Application\Controller\Front;

use Framework\AbstractController;
use Application\Service\CommentService;

class CommentController extends AbstractController
{
    private CommentService $commentService;

    public function __construct()
    {
        parent::__construct();

        $this->commentService = new CommentService;
    }
    
    /**
     * editComment
     *
     * @Route(path="/comment/edit/{id}", name="edit.comment", requirement="[0-9]")
     * 
     * @param  int $ident
     * @return void
     */
    public function editComment($ident)
    {
        $comment = $this->commentService->getComment($ident);

        //Si le commentaire n'appartient pas l'auteur
        if (! $this->authorize($comment->getAutor())) {
            $this->addFlash("error", "Vous ne pouvez pas modifier ce commentaire.");
            $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
        }

        $this->addFlash('success', "Le commentaire à bien été modifié.");
    }

    /**
     * editComment
     *
     * @Route(path="/comment/delete/{id}", name="delete.comment", requirement="[0-9]")
     * 
     * @param  int $ident
     * @return void
     */
    public function deleteComment($ident)
    {
        $comment = $this->commentService->getComment($ident);

        //Si le commentaire n'appartient pas l'auteur
        if (! $this->authorize($comment->getAutor())) {
            $this->addFlash("error", "Vous ne pouvez pas supprimer ce commentaire.");
            $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
        }

        $this->addFlash('success', "Le commentaire à bien été supprimer.");
    }
}