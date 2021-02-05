<?php $title = $post->getTitle(); ?>

<section>
    <header class="ratio ratio-16x9 mb-3">
        <img src="<?php escHtml($post->getFeatured()->getUrl()); ?>" alt="<?php $post->getFeatured()->getAlt(); ?>">
    </header>

    <div>
        <h2 class="mb-3 fs-1">Article <?php escHtml($post->getTitle()); ?></h2>
        <p class="mb-0"><span class="fw-bold">Publié le : </span> <?php escHtml($post->getCreatedAt()->format('d/m/Y')); ?></p>
        <p class="mb-0"><span class="fw-bold">Categorie :</span> <a href="/blog/categorie/<?php escHtml($post->getCategory()->getSlug()); ?>"><?php escHtml($post->getCategory()->getName()); ?></a></p>
    
        <p class="my-5"><?php echo $post->getContent(); ?><p>

    </div>
</section>


<?php
if ($comments) : 
    require_once __ROOT__ .'/Application/template/front/comment/listComments.php'; 

    //ajout des modaux pour modifier et supprimer un commentaire
    require_once __ROOT__ .'/Application/template/front/comment/editComment.php';

endif;

if ($form) : escHtml($form); endif; ?>

<!-- Si l'utilisateur n'est pas connecté ou n'a pas de compte -->
<?php if (! $appUser) : ?>
    <aside class="bg-light p-3 p-lg-5">
        <h3 class="fs-2">Commentaires</h3>
        <p>Pour pouvoir ajouter un commentaire, vous devez être inscris</p>
        <hr class="my-4 my-lg-5">
        <p class="d-flex justify-content-end">
            <a class="btn btn-primary" href="/inscription">Inscription</a>
            <a class="ms-2 btn btn-outline-primary" href="/connexion">Connexion</a>
        </p>
    </aside>
<?php endif; ?>

