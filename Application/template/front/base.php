<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php isset($title) ? escHtml($title) : 'Mon super site' ?></title>
        <meta charset="utf-8" />
    </head>

    <body>
        <header>
            <h1><a href="/">Mon super site</a></h1>
        </header>

        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <?php if (session_status() == PHP_SESSION_ACTIVE && !isset($_SESSION['user'])) : ?>
                    <li><a href="/inscription">Inscription</a></li>
                    <li><a href="/connexion">Connexion</a></li>
                <?php endif; ?>
                <?php if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['user'])) : ?>
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
                    foreach($messages as $message) : ?>
                        <p><?php escHtml($message) ?></p>
                    <?php endforeach;
                endif; 
            ?>
            <?php escHtml($content) ?>
            </section>
        </main>
            
        <footer></footer>
    </body>
</html>