<?php $title = "Profil de ". $user->getPseudo();

    if ($user) : ?>
    <section class="my-8">
        <header>
            <h2>Profil de <?php escHtml($user->getPseudo()); ?></h2>
        </header>

        <?php if ($user->getIsValide()) : ?>
            <div class="row my-5">
                <?php if($user->getavatar()) : ?>
                <div class="col-3">
                    <img src="<?php escHtml($user->getAvatar()->getUrl()) ?>">
                </div>
                <?php endif; ?>
                <div class="col-9">
                    <p class="mb-0"><span class="font-bold">Inscrit le :</span> <?php escHtml($user->getCreatedAt()->format('d m Y')) ?></span></p>
                    <?php if($user->getConnectedAt()) : ?>
                    <p class="mb-0"><span class="font-bold">Dernière connection :</span> <?php escHtml($user->getConnectedAt()->format('d m Y')) ?></span></p>
                    <?php endif; ?>
                    <p class="mb-0"><span class="font-bold">Adresse email :</span> <?php escHtml($user->getEmail()) ?></span></p>
                    <p>Profil validé</p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (! $user->getIsValide()) : ?>
        <footer class="mt-5">
            <span>Valider la demande : </span>
            <a class="btn btn-success" href="/admin/valide/user/<?php escHtml($user->getId()) ?>">Oui</a>
            <a class="btn btn-danger delete-item" href="#delete-modal" data-url="/admin/user/delete/<?php escHtml($user->getId()) ?>">Non</a>
        </footer>
        <?php endif; ?>

    </section>

<?php endif; ?>