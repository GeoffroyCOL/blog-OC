<?php

namespace Application\Controller\Back;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\PostService;
use Application\Form\Post\AddPostType;

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
}
