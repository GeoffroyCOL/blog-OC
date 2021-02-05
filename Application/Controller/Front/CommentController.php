<?php

namespace Application\Controller\Front;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Framework\Error\NotFoundException;
use Application\Service\CommentService;

class CommentController extends AbstractController
{
    private CommentService $commentService;
    private Request $request;

    public function __construct()
    {
        parent::__construct();

        $this->commentService = new CommentService;
        $this->request = new Request;
    }
    
    /**
     * editComment
     *
     * @Route(path="/comment/edit/{id}", name="edit.comment", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function editComment($ident)
    {
        $comment = $this->commentService->getComment($ident);

        //Si le commentaire n'appartient pas l'auteur
        if (! $this->authorize($comment->getAutor())) {
            $this->addFlash("info", "Vous ne pouvez pas modifier ce commentaire.");
            $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
        }

        //Si formulaire vide ou champs non renseigné
        if ($this->request->method() === 'POST') {
            if (empty($this->request->postData('content'))) {
                $this->addFlash("info", "Le commentaire est vide.");
                $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
            }

            if (! $this->request->postExists('content')) {
                $this->addFlash("info", "Le commentaire n'a pas pu être modifié.");
                $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
            }

            //Modification du contenue
            $comment->setContent($this->request->postData('content'));
            $this->commentService->edit($comment);

            $this->addFlash('success', "Le commentaire à bien été modifié.");
            $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
        }
    }
    

    /**
     * deleteComment
     *
     * @Route(path="/comment/delete/{id}", name="delete.comment", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function deleteComment($ident): Response
    {
        $comment = $this->commentService->getComment($ident);

        //Si le commentaire n'appartient pas l'auteur
        if (! $this->authorize($comment->getAutor())) {
            $this->addFlash("error", "Vous ne pouvez pas supprimer ce commentaire.");
            $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
        }

        $this->commentService->delete($comment);

        $this->addFlash('success', "Le commentaire à bien été supprimé.");
        $this->redirection('/blog/article/'.$comment->getPost()->getSlug());
    }
}
