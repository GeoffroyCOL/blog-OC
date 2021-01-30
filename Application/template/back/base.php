<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php isset($title) ? escHtml($title) : 'Mon super site' ?></title>
        <meta charset="utf-8" />
    </head>

    <body>
        <header>
            <h1><a href="/">Administration</a></h1>
        </header>

        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <?php if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['user'])) : ?>
                    <li><a href="/admin/categories">Catégories</a></li>
                    <li><a href="/admin/posts">Articles</a></li>
                    <li><a href="/admin/commentaires">Commentaires</a></li>
                    <li><a href="/deconnexion">Déconnexion</a></li>
                    <li><a href="/admin/profil">Profil</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <main>
            <section id="main">
                <?php
                $messages = showMessageFlash();
            
                if (! empty($messages)) :
                    foreach ($messages as $message) : ?>
                        <p><?php escHtml($message) ?></p>
                    <?php endforeach;
                endif;
            ?>
                <?php isset($messageError) ? escHtml($messageError) : '' ?>
                <?php escHtml($content) ?>
            </section>
        </main>
            
        <footer></footer>
    </body>
</html>