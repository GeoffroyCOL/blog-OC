<?php

namespace Application\Controller\Back;

use Framework\Email\Email;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Framework\Error\NotFoundException;
use Application\Service\CommentService;

class CommentController extends AbstractController
{
    private CommentService $commentService;
    private Email $email;

    public function __construct()
    {
        parent::__construct();

        $this->commentService = new CommentService;
        $this->email = new Email;
    }
    
    /**
     * comments
     *
     *  @Route(path="/admin/commentaires", name="comments")
     *
     * @return Response
     */
    public function comments(): Response
    {
        $this->isAccess('admin');

        return $this->render('back/comment/comments.php', [
            'comments'  => $this->commentService->getAll()
        ]);
    }
    
    /**
     * valide
     *
     * @Route(path="/admin/comment/valide/{id}", name="edit.post", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function valide($ident): Response
    {
        try {
            $this->isAccess('admin');

            $comment = $this->commentService->getComment($ident);
            $this->commentService->valide($comment);
            $this->email->sendValideComment($comment);

            $this->addFlash('success', 'Le commentaire à bien été validé.');
        } catch (NotFoundException $e) {
            $this->addFlash('error', $e->getMessage());
        } finally {
            $this->redirection('/admin/commentaires');
        }
    }

    /**
     * deleteComment
     *
     * @Route(path="/admin/comment/delete/{id}", name="delete.comment", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function deleteComment($ident): Response
    {
        try {
            $this->isAccess('admin');

            $comment = $this->commentService->getComment($ident);
            $this->commentService->delete($comment);

            $this->addFlash('success', "Le commentaire à bien été supprimer.");
        } catch (NotFoundException $e) {
            $this->addFlash('error', $e->getMessage());
        } finally {
            $this->redirection('/admin/commentaires');
        }
    }
}
