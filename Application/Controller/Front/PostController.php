<?php

namespace Application\Controller\Front;

use Framework\Pagination;
use Framework\HTTP\Request;
use Framework\HTTP\Response;
use Framework\AbstractController;
use Application\Service\PostService;
use Framework\Error\NotFoundException;
use Application\Service\CommentService;
use Application\Form\Comment\AddCommentType;

class PostController extends AbstractController
{
    private PostService $postService;
    private Request $request;
    private Pagination $pagination;
    private CommentService $commentService;

    public function __construct()
    {
        parent::__construct();

        $this->postService = new PostService;
        $this->request = new Request;
        $this->pagination = new Pagination;
        $this->commentService = new CommentService;
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
        $numberPostPerPage = 6;

        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;

        if ($page < 1) {
            throw new NotFoundException("Pas d'articles pour la page demandée", 404);
        }

        $posts = $this->postService->getAll(($page - 1), $numberPostPerPage);
        if (empty($posts)) {
            $this->addFlash('info', "Pour la page {$page}, pas d'article à afficher.");
        }

        $this->pagination->setParams($numberPostPerPage, $page, $this->postService->numberPost(), '/blog');
        
        return $this->render('front/post/blog.php', [
            'posts'         => $posts,
            'pagination'    => $this->pagination->generateHTML(),
            'pageMenu'      =>'blog',
            'pageTitle'     => 'Actualités'
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
        $numberPostPerPage = 6;

        $page = $this->request->getExists('page') ? $this->request->getData('page') : 1;
        if ($page < 1) {
            throw new NotFoundException("Pas d'articles pour la page demandée", 404);
        }

        $posts = $this->postService->getPostsByCategory($category, ($page - 1), $numberPostPerPage);
        
        if (empty($posts)) {
            $this->addFlash('success', "Pour la page {$page}, pas d'article à afficher.");
        }
        
        $this->pagination->setParams($numberPostPerPage, $page, $this->postService->numberPost($category), '/blog/categorie/' . $category);

        return $this->render('front/post/blog.php', [
            'posts'         => $posts,
            'pagination'    => $this->pagination->generateHTML(),
            'pageMenu'      =>'blog',
            'pageTitle'     => 'Actualités'
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
        $post = $this->postService->getPostBySlug($slug);
        $comments = $this->commentService->getCommentForPost($post);

        //Si seulement l'utilisateur est connecté
        if ($this->getUser() !== null) {
            $form = $this->createForm(AddCommentType::class);
            $formulaire = $form->createView();
            if ($this->request->method() === 'POST' && $form->isValid()) {
                $comment = $form->getData();
                $comment->setPost($post);
                $comment->setAutor($this->getUser());

                $this->commentService->add($comment);
                $this->addFlash('success', "Le commentaire à bien été ajouter.");
                $this->redirection('/blog/article/'.$slug);
            }
        }

        return $this->render('front/post/post.php', [
            'post'          => $post,
            'comments'      => $comments,
            'form'          => $formulaire ?? null,
            'pageMenu'      => 'blog',
            'pageTitle'     => 'Actualités'
        ]);
    }
}
