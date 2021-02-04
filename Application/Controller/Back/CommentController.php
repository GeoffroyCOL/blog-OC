<?php

namespace Application\Controller\Back;

use Framework\Pagination;
use Framework\Email\Email;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Framework\Error\NotFoundException;
use Application\Service\CommentService;

class CommentController extends AbstractController
{
    private CommentService $commentService;
    private Email $email;
    private Request $request;
    private Pagination $pagination;

    public function __construct()
    {
        parent::__construct();

        $this->commentService = new CommentService;
        $this->email = new Email;
        $this->request = new Request;
        $this->pagination = new Pagination;
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
        $numberPostPerPage = 10;

        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;
        if ($page < 1) {
            throw new NotFoundException("Pas de commentaires pour la page demandée", 404);
        }

        $comments = $this->commentService->getAll(($page - 1), $numberPostPerPage);

        if (empty($comments)) {
            $this->addFlash('info', "Pour la page {$page}, pas de commentaires à afficher.");
        }

        $this->pagination->setParams($numberPostPerPage, $page, $this->commentService->numberPost(), '/admin/commentaires');

        return $this->render('back/comment/comments.php', [
            'comments'          => $comments,
            'pageMenu'          => 'comments',
            'pagination'        => $this->pagination->generateHTML(),
            'numeroPage'        => $page,
            'numberPostPerPage' => $numberPostPerPage,
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

            if ($comment->getIsValide()) {
                $this->addFlash('info', 'Le commentaire à déjà été validé.');
                $this->redirection('/admin/commentaires');
            }

            $this->email->sendValideComment($comment);
            $this->addFlash('success', 'Le commentaire à bien été validé.');
        } catch (NotFoundException $e) {
            $this->addFlash('danger', $e->getMessage());
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
            $this->addFlash('danger', $e->getMessage());
        } finally {
            $this->redirection('/admin/commentaires');
        }
    }
    
    /**
     * showComment
     *
     * @Route(path="/admin/comment/show/{id}", name="show.comment", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function showComment($ident): Response
    {
        try {
            $this->isAccess('admin');

            $comment = $this->commentService->getComment($ident);
            
            return $this->render('back/comment/showComment.php', [
            'comment'   => $comment,
            'pageMenu'  => 'comments'
        ]);
        } catch (NotFoundException $e) {
            $this->addFlash('error', $e->getMessage());
            $this->redirection('/admin/commentaires');
        }
    }
}
