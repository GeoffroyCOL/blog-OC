<?php 

    $title = "Profil utilisateur";

    if ($user) : ?>

    <h2>Profil de <?php escHtml($user->getPseudo()); ?></h2>

    <?php if (! $user->getIsValide()) : ?>
        <a href="/admin/valide/user/<?php escHtml($user->getId()) ?>">Valider l'inscription</a>
    <?php endif;
endif;