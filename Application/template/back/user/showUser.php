<?php 

    $title = "Profil utilisateur";

    if ($user) : ?>

    <h2>Profil de <?php escHtml($user->getPseudo()); ?></h2>

    <?php if (! $user->getIsValide()) : ?>
        <p>Validé : </p>
        <a href="/admin/valide/user/<?php escHtml($user->getId()) ?>">Oui</a>
        <a href="/admin/user/delete/<?php escHtml($user->getId()) ?>">Non</a>
    <?php endif;
endif;