<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php isset($title) ? escHtml($title) : 'Mon super site' ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="/public/asset/css/main.css" rel="stylesheet" />
        
        <meta charset="utf-8" />
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="/">Retour site</a>
                    <button class="navbar-toggler" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#navbarSupportedContent" 
                            aria-controls="navbarSupportedContent" 
                            aria-expanded="false" 
                            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?php if ($appUser->getRole() === 'admin') : ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'users')); endif; ?>" href="/admin/users">Utilisateurs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'posts')); endif; ?>" href="/admin/posts">Articles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'categories')); endif; ?>" href="/admin/categories">Catégories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($pageMenu)) : escHtml(activeNavigation($pageMenu, 'comments')); endif; ?>" href="/admin/commentaires">Commentaires</a>
                            </li>
                        </ul>
                        <?php endif; ?>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/profil">Profil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="container my-5 position-relative">
            <?php
                require_once __ROOT__ . '/Application/template/message.php';
                escHtml($content);
                require_once __ROOT__ . '/Application/template/delete-modal.php';
            ?>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
            
            <script src="/public/asset/js/delete-toast.js"></script>
            <script src="/public/asset/js/delete-element.js"></script>
        </main>
            
        <footer>
        </footer>
    </body>
</html>