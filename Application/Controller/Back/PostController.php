<?php

namespace Application\Controller\Back;

use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\PostService;

class PostController extends AbstractController
{
    private PostService $postService;

    public function __construct()
    {
        parent::__construct();

        $this->postService = new PostService;
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
}