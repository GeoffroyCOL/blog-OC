<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php isset($title) ? escHtml($title) : 'Mon super site' ?></title>

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="/public/asset/css/main.css" rel="stylesheet" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container">
                    <a class="navbar-brand" href="/">Blog</a>
                    <button class="navbar-toggler" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#navbarSupportedContent" 
                            aria-controls="navbarSupportedContent" 
                            aria-expanded="false" 
                            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'blog')); endif; ?>" href="/blog">Articles</a>
                            </li>
                            <?php if (! $appUser) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'login')); endif; ?>" href="/connexion">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'sigin')); endif; ?>" href="/inscription">Inscription</a>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <?php if ($appUser) : ?>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/profil">Profil</a>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>

            <?php if (isset($pageMenu) && file_exists(__ROOT__ . '/public/img/'. $pageMenu . '.jpg')) : ?>
            <div class="position-relative banner" style="background-image: url('/public/img/<?php escHtml($pageMenu) ?>.jpg')">
                <div class="position-absolute site-title text-center">
                <h1 class="text-white text-uppercase"><?php escHtml(isset($pageTitle) ? $pageTitle : 'Développeur WEB'); ?></h1>
            </div>
            <?php endif; ?>
        </header>

        <main class="container my-5 position-relative">
            <?php
                $templateMessage = __ROOT__ . '/Application/template/message.php';
                require_once $templateMessage;

                escHtml($content);
                
                require_once __ROOT__ . '/Application/template/delete-modal.php';
            ?>
                
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
            
            <script src="/public/asset/js/delete-toast.js"></script>
            <script src="/public/asset/js/delete-element.js"></script>
            <script src="/public/asset/js/edit-comment.js"></script>
        </main>
            
        <footer class="bg-dark p-5">
            <div class="container text-center">
                <p class="text-white fs-3">Geoffroy Colpart</p>
                <hr class="bg-light w-50 mx-auto my-md-4">
                <p class="d-flex flex-column flex-md-row justify-content-md-center">
                    <a href="https://www.linkedin.com/in/geoffroy-colpart/" target="_blank" class="text-white not-underline mb-2"><i class="fab fa-linkedin-in"></i> Linkedin</a>
                    <a href="https://github.com/GeoffroyCOL" class="text-white not-underline mb-2 ms-md-3" target="_blank"><i class="fab fa-github"></i> Gihub</a>
                    <a href="https://geoffroy-colpart.fr/" class="text-white not-underline ms-md-3"><i class="fas fa-globe"></i> geoffroy-colpart.fr</a>
                </p>
            </div>
        </footer>
    </body>
</html>