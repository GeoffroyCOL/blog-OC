<?php $title = "Profil de ". $user->getPseudo();

if ($user) : ?>
    <section>
        <header class="mb-3 mb-md-5">
            <h2 class="mb-0">Profil de <?php escHtml($user->getPseudo()); ?></h2>
            <?php if ($user->getIsValide()) : ?><span class="badge bg-success">Profil validé</span> <?php endif; ?>
        </header>

        <?php if ($user->getIsValide()) : ?>
            <div class="row">
                <?php if ($user->getavatar()) : ?>
                <div class="col-12 col-md-3">
                    <img class="img-fluid" src="<?php escHtml($user->getAvatar()->getUrl()) ?>">
                </div>
                <?php endif; ?>
                <div class="col-12 col-md-9">
                    <p class="mb-0"><span class="fw-bold">Inscrit le :</span> <?php escHtml($user->getCreatedAt()->format('d/m/Y')) ?></span></p>
                    <?php if ($user->getConnectedAt()) : ?>
                    <p class="mb-0"><span class="fw-bold">Dernière connection :</span> <?php escHtml($user->getConnectedAt()->format('d/m/Y')) ?></span></p>
                    <?php endif; ?>
                    <p class="mb-0"><span class="fw-bold">Adresse email :</span> <?php escHtml($user->getEmail()) ?></span></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (! $user->getIsValide()) : ?>
        <footer class="mt-5">
            <span>Valider la demande : </span>
            <a class="btn btn-sm btn-success" href="/admin/valide/user/<?php escHtml($user->getId()) ?>">Oui</a>
            <a  class="btn btn-sm btn-danger delete-item" 
                href="#delete-modal" 
                data-bs-url="/admin/user/delete/<?php escHtml($user->getId()) ?>"
                data-bs-toggle="modal" 
                data-bs-target="#deleteModal" 
                data-entity="cet utilisateur">Non</a>
        </footer>
        <?php endif; ?>

    </section>
<?php endif; ?>