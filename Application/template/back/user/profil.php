<?php $title = "Profil"; ?>

<?php if (isset($user)) : ?>

    <h2>Page de profil <?php escHtml($user->getPseudo()); ?></h2>

    <a href="/admin/edit/profil">Modifier</a>

    <?php if ($user->getrole() === 'reader') : ?>
        <a href="/admin/delete/profil">Supprimer</a>
    <?php endif; ?>

    <?php if ($user->getrole() === 'admin') : ?>
        <a href="/admin/users">Liste des utilisateurs</a>
    <?php endif; ?>

    <p>Email : <?php escHtml($user->getEmail()); ?></p>

    <?php if ($user->getAvatar()) : ?>
        <p>Avatar</p>
        <img src="<?php pathImage($user->getAvatar()->getUrl()); ?>" />
    <?php endif; ?>

<?php endif; 