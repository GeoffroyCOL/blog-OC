<?php $title = "Votre profil"; ?>

<?php if (isset($user)) : ?>
    <section class="my-8">
        <header>
            <h2>Page de profil <?php escHtml($user->getPseudo()); ?></h2>
        </header>

        <div>
            <a class="btn btn-info" href="/admin/edit/profil">Modifier</a>
        </div>

        <div class="my-5 row">
            <?php if ($user->getAvatar()) : ?>
                <div class="col-4">
                    <img src="<?php pathImage($user->getAvatar()->getUrl()); ?>" />
                </div>
            <?php endif; ?>

            <div class="col-8">
                <p class="mb-0"><span class="font-bold uppercase">Adresse email :</span> <?php escHtml($user->getEmail()); ?></p>
                <p class="mb-0"><span class="font-bold uppercase">Inscription</span> <?php escHtml($user->getCreatedAt()->format('d m Y')); ?></p>
                <?php if ($user->getConnectedAt()) : ?>
                    <p class="mb-0"><span class="font-bold uppercase">Dernière connection</span> <?php escHtml($user->getConnectedAt()->format('d m Y')); ?></p>
                <?php endif; ?>

                <?php if ($user->getRole() === 'reader') : ?>
                    <p><a class="btn-danger btn" href="/admin/delete/profil">Supprimer</a></p>
                <?php endif; ?>
                <p class="mt-3"><a class="btn btn-link" href="/deconnexion">Déconnexion</a></p>
            </div>
        </div>
    </section>
<?php endif; 