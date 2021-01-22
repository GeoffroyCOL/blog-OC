<!DOCTYPE html>
<html>
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