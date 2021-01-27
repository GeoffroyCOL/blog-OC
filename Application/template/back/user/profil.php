<?php $title = "Profil"; ?>

<?php if (isset($user)) : ?>

    <h2>Page de profil <?php escHtml($user->getPseudo()); ?></h2>

    <a href="/admin/edit/profil">Modifier</a>

    <p>Email : <?php escHtml($user->getEmail()); ?></p>

    <?php if ($user->getAvatar()) : ?>
        <p>Avatar</p>
        <img src="<?php pathImage($user->getAvatar()->getUrl()); ?>" />
    <?php endif; ?>

<?php endif; 