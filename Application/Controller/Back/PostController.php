<?php

namespace Application\Controller\Back;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\PostService;
use Application\Form\Post\AddPostType;
use Application\Form\Post\EditPostType;

class PostController extends AbstractController
{
    private PostService $postService;
    private Request $request;

    public function __construct()
    {
        parent::__construct();

        $this->postService = new PostService;
        $this->request = new Request;
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

        return $this->render('back/post/posts.php', [
            'posts' => $this->postService->getAll()
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
            $this->redirection('/admin/posts');
        }

        return $this->render('back/post/addPost.php', [
            'form' => $form->createView()
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
                $this->redirection('/admin/posts');
            }
        } catch (NotFoundEntityException $e) {
            $messageError = $e->getMessage();
        }
        return $this->render('back/post/editPost.php', [
            'form'          => $form->createView(),
            'messageError'  => $messageError ?? ''
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
        } catch(NotFoundEntityException $e) {
            $messageError = $e->getMessage();;
        }
        $this->redirection('/admin/posts');
    }
}
