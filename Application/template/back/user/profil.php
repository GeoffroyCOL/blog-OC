<?php $title = "Votre profil"; ?>

<?php if (isset($user)) : ?>
    <section>
        <header class="mb-3 mb-md-5">
            <h2>Votre profil <?php escHtml($user->getPseudo()); ?></h2>
            <a class="btn btn-primary btn-sm" href="/admin/edit/profil">Modifier</a>
            <a class="btn btn-secondary btn-sm" href="/deconnexion">Déconnexion</a>
        </header>

        <div class="row">
            <?php if ($user->getAvatar()) : ?>
                <div class="col-12 col-md-3">
                    <img class="img-fluid" src="<?php pathImage($user->getAvatar()->getUrl()); ?>" />
                </div>
            <?php endif; ?>

            <div class="col-12 col-md-9">
                <p class="mb-0"><span class="fw-bold text-uppercase">Adresse email :</span> <?php escHtml($user->getEmail()); ?></p>
                <p class="mb-0"><span class="fw-bold text-uppercase">Inscription :</span> <?php escHtml($user->getCreatedAt()->format('d/m/Y')); ?></p>
                <?php if ($user->getConnectedAt()) : ?>
                    <p class="mb-0"><span class="fw-bold text-uppercase">Dernière connection :</span> <?php escHtml($user->getConnectedAt()->format('d/m/Y')); ?></p>
                <?php endif; ?>

                <?php if ($user->getRole() === 'reader') : ?>
                    <p class="mt-3 mt-md-5"><a class="btn-danger btn btn-sm" href="/admin/delete/profil">Supprimer votre compte</a></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif;
