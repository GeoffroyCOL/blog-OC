<?php $title= "Valider un commentaire"; ?>

<section>
    <header class="mb-3 mb-md-5">
        <h2>Valider un commentaire</2>
    </header>

        <?php if ($comment) : ?>
        <div>
            <p class="mb-0"><span class="fw-bold">Publié le </span> <?php escHtml($comment->getCreatedAt()->format('d/m/Y')); ?></p>
            <p class="mb-0"><span class="fw-bold">Par </span><?php escHtml($comment->getAutor()->getPseudo()); ?></p>

            <p class="mb-0 mt-4 fw-bold">Commentaire</p>
            <p class="my-3"><?php escHtml($comment->getContent()); ?></p>
        </div>

        <?php if ($comment->getIsValide() == 0) : ?>
        <footer>
            <span class="mb-0">Valider le commentaire ? </span>
            <a class="mb-0 btn btn-sm btn-success" href="/admin/comment/valide/<?php escHtml($comment->getId()); ?>">Oui</a>
            <button class="btn btn-danger btn-sm delete-item" 
                    href="#delete-modal" 
                    data-bs-url="/admin/comment/delete/<?php escHtml($comment->getId()); ?>"
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteModal" 
                    data-entity="ce commentaire">Non</button>
        </footer>
        <?php endif;
    endif; ?>
</section>
