<?php $title = "Profil"; ?>

<?php if ($user) : ?>

    <h2>Page de profil <?php escHtml($user->getPseudo()); ?></h2>

<?php endif; 