<?php $title= "Afficher un commentaire"; ?>

<section class="col-12 my-8">
    <header>
        <h2>Afficher un commentaire</2>
    </header>

    <?php if ($comment) : ?>
        <div>
            <p class="mb-0"><span class="font-bold">Publié le </span> <?php escHtml($comment->getCreatedAt()->format('d m Y')); ?></p>
            <p class="mb-0"><span class="font-bold">Par </span><?php escHtml($comment->getAutor()->getPseudo()); ?></p>

            <p class="mb-0 mt-4 font-bold">Commentaire</p>
            <p><?php escHtml($comment->getContent()); ?></p>
        </div>

    <?php if ($comment->getIsValide() == 0) : ?>
        <footer>
            <span class="mb-0">Valider le commentaire </span>
            <a class="mb-0 btn btn-success" href="/admin/comment/valide/<?php escHtml($comment->getId()); ?>">Oui</a>
            <a class="btn btn-danger delete-item" href="#delete-modal" data-url="/admin/comment/delete/<?php escHtml($comment->getId()); ?>">Non</a>
        </footer>
    <?php endif;
    endif; ?>

</section>
