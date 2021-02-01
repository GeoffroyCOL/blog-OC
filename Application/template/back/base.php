<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php isset($title) ? escHtml($title) : 'Mon super site' ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

        <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!-- Minified Cirrus CSS -->
        <link rel="stylesheet" href="https://unpkg.com/cirrus-ui">
        
        <meta charset="utf-8" />
    </head>

    <body>
        <header class="header u-unselectable header-animated header-dark">
            <div class="header-brand">
                <div class="nav-item no-hover">
                    <a href="/"><h6 class="title">Retour site</h6></a>
                </div>
                <div class="nav-item nav-btn" id="header-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <nav class="header-nav" id="header-menu">
                <?php if ($appUser && $appUser->getRole() === 'admin') : ?>
                    <ul class="nav-left">
                        <li class="nav-item <?php if(isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'users')); endif; ?>">
                            <a href="/admin/users">Utilisateurs</a>
                        </li>
                        <li class="nav-item <?php if(isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'posts')); endif; ?>">
                            <a href="/admin/posts">Articles</a>
                        </li>
                        <li class="nav-item <?php if(isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'categories')); endif; ?>">
                            <a href="/admin/categories">Catégories</a>
                        </li>
                        <li class="nav-item <?php if(isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'comments')); endif; ?>">
                            <a href="/admin/commentaires">Commentaires</a>
                        </li>
                    </ul>
                <?php endif; ?>
                <ul class="nav-right">
                    <li class="nav-item rtl">
                        <a href="/admin/profil" class="avatar" data-text='<?php escHtml(ucfirst(substr($appUser->getPseudo(), 0, 1))); ?>'></a>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="content">
                <?php 
                    require_once __ROOT__ . '/Application/template/message.php'; 
                    escHtml($content);
                    require_once __ROOT__ . '/Application/template/delete-modal.php';
                ?>

                <script src="/public/asset/js/delete-elements.js"></script>
                <script src="/public/asset/js/delete-toast.js"></script>
        </main>
            
        <footer>
        </footer>
    </body>
</html>