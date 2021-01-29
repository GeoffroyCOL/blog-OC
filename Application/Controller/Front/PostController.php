<?php

namespace Application\Controller\Front;

use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\PostService;
use Framework\Error\NotFoundException;

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
     * blog
     *
     * @Route(path="/blog", name="blog")
     * 
     * @return Response
     */
    public function blog(): Response
    {
        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;

        if ($page < 1) {
            throw new NotFoundException("Pas d'articles pour la page demandée", 404);
        }

        $posts = $this->postService->getAll(($page - 1), 6);
        
        if (empty($posts)) {
            $this->addFlash('success', "Pour la page {$page}, pas d'article à afficher.");
        }
        
        return $this->render('front/post/blog.php', [
            'posts' => $posts
        ]);
    }
    
    /**
     * listPostsByCategory
     *
     * @Route(path="/blog/categorie/{slug}", name="list.posts.category", requirement="[a-zA-Z0-9-]")
     * 
     * @param  string $category
     * @return Response
     */
    public function listPostsByCategory($category): Response
    {
        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;
        if ($page < 1) {
            throw new NotFoundException("Pas d'articles pour la page demandée", 404);
        }

        $posts = $this->postService->getPostsByCategory($category, ($page - 1), 6);
        
        if (empty($posts)) {
            $this->addFlash('success', "Pour la page {$page}, pas d'article à afficher.");
        }
        
        return $this->render('front/post/blog.php', [
            'posts' => $posts
        ]);
    }
    
    /**
     * singlePost
     *
     * @Route(path="/blog/article/{slug}", name="post", requirement="[a-zA-Z0-9-]")
     * 
     * @param  string $slug
     * @return Response
     */
    public function singlePost($slug): Response
    {
        $post = $this->postService->getPost(['slug' => $slug]);

        return $this->render('front/post/post.php', [
            'post' => $post
        ]);
    }
}