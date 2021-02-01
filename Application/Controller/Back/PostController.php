<?php

namespace Application\Controller\Back;

use Framework\Pagination;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\PostService;
use Application\Form\Post\AddPostType;
use Framework\Error\NotFoundException;
use Application\Form\Post\EditPostType;

class PostController extends AbstractController
{
    private PostService $postService;
    private Request $request;
    private Pagination $pagination;

    public function __construct()
    {
        parent::__construct();

        $this->postService = new PostService;
        $this->request = new Request;
        $this->pagination = new Pagination;
    }
    
    /**
     * listPosts
     *
     * @Route(path="/admin/posts", name="posts")
     *
     * @return Response
     */
    public function listPosts(): Response
    {
        $this->isAccess('admin');
        $numberPostPerPage = 6;

        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;
        if ($page < 1) {
            throw new NotFoundException("Pas d'articles pour la page demandée", 404);
        }

        $posts = $this->postService->getAll(($page - 1), $numberPostPerPage);

        if (empty($posts)) {
            $this->addFlash('info', "Pour la page {$page}, pas d'article à afficher.");
        }

        $this->pagination->setParams($numberPostPerPage, $page, $this->postService->numberPost(), '/admin/posts');
        return $this->render('back/post/posts.php', [
            'posts'             => $posts,
            'pageMenu'          => 'posts',
            'pagination'        => $this->pagination->generateHTML(),
            'numeroPage'        => $page,
            'numberPostPerPage' => $numberPostPerPage,
        ]);
    }
    
    /**
     * addPost
     *
     * @Route(path="/admin/post/add", name="add.post")
     *
     * @return Response
     */
    public function addPost(): Response
    {
        $this->isAccess('admin');

        $form = $this->createForm(AddPostType::class);

        if ($this->request->method() === 'POST' && $form->isValid()) {
            $this->postService->add($form->getData());
            $this->addFlash('success', 'Votre article a bien été ajouté.');
            $this->redirection('/admin/posts');
        }

        return $this->render('back/post/addPost.php', [
            'form'          => $form->createView(),
            'pageMenu'      => 'posts',
            'formErrors'    => $form->getAllErrors()
        ]);
    }
    
    /**
     * editPost
     *
     * @Route(path="/admin/post/edit/{id}", name="edit.post", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function editPost($ident): Response
    {
        try {
            $this->isAccess('admin');

            $post = $this->postService->getPost($ident);
            $form = $this->createForm(EditPostType::class, $post);
            if ($this->request->method() === 'POST' && $form->isValid()) {
                $this->postService->edit($form->getData());
                $this->addFlash('success', "L'article {$post->getTitle()} a bien été modifié.");
                $this->redirection('/admin/posts');
            }
        } catch (NotFoundEntityException $e) {
            $this->addFlash('danger', $e->getMessage());
        }
        return $this->render('back/post/editPost.php', [
            'form'          => $form->createView(),
            'post'          => $post,
            'formErrors'    => $form->getAllErrors(),
            'pageMenu'      => 'posts',
        ]);
    }
    
    /**
     * deletePost
     *
     * @Route(path="/admin/post/delete/{id}", name="delete.post", requirement="[0-9]")
     *
     * @param  int $ident
     * @return Response
     */
    public function deletePost($ident): Response
    {
        try {
            $this->isAccess('admin');
            
            $post = $this->postService->getPost($ident);
            $this->postService->delete($post);
            $this->addFlash('success', "L'article {$post->getTitle()} a bien été supprimé.");
        } catch (NotFoundEntityException $e) {
            $this->addFlash('danger', $e->getMessage());
        } finally {
            $this->redirection('/admin/posts');
        }
    }
}
