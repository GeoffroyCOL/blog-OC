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
                <li><a href="/connexion">Connexion</a></li>
            </ul>
        </nav>

        <main>
            <section id="main">
            <?php escHtml($content) ?>
            </section>
        </main>
            
        <footer></footer>
    </body>
</html>