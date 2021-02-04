<aside class="my-5">
    <h3 class="mb-3">Commentaires</h3>

    <?php foreach ($comments as $comment) : ?>
        <div class="card mb-3 mb-md-5">
            <header class="card-header d-flex justify-content-between">
                <p class="mb-0 text-primary fw-bold"><?php escHtml($comment->getAutor()->getPseudo());?></p>
                <p class="mb-0 ms-3"><?php escHtml($comment->getCreatedAt()->format('d m Y'));?></p>
            </header>
            <div class="card-body">
                <p id="comment-<?php escHtml($comment->getId()) ?>" class="card-text"><?php escHtml($comment->getContent());?></p>
            </div>

            <?php if ($appUser && $appUser->getPseudo() === $comment->getAutor()->getPseudo()) : ?>
            <footer class="card-footer text-end">
                <button type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editCommentModal"
                        data-id="<?php escHtml($comment->getId()) ?>"
                        class="btn btn-sm btn-info text-light" 
                        data-bs-url="/comment/edit/<?php escHtml($comment->getId()) ?>">Modifier</i>
                </button>

                <button type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal" 
                        data-entity="votre commentaire" 
                        class="ms-2 btn btn-sm btn-outline-danger" 
                        data-bs-url="/comment/delete/<?php escHtml($comment->getId()) ?>">Supprimer</i>
                </button>
            </footer>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

</aside>