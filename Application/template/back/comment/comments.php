<?php $title = "Liste des commentaires"; ?>

<section>
    <header class="mb-3 mb-md-5">
        <h2>Liste des commentaires</h2>
    </header>

<?php if ($comments) : ?>
    <div class="my-5 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Commentaire</th>
                    <th>Auteur</th>
                    <th>Article</th>
                    <th>Validé</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1 + ($numberPostPerPage * ($numeroPage - 1));
                foreach ($comments as $comment) : ?>
                    <tr class="<?php if (! $comment->getIsValide()) : escHtml('bg-not-valide'); endif; ?>">
                        <td><?php escHtml($i) ?></td>
                        <td><a href="/admin/comment/show/<?php escHtml($comment->getId()) ?>"><?php escHtml($comment->getContent()) ?></a></td>
                        <td><?php escHtml($comment->getAutor()->getPseudo()) ?></td>
                        <td><?php escHtml($comment->getPost()->getTitle()) ?></td>
                        <td><?php escHtml($comment->getIsValide() ? 'Oui': 'Non'); ?></td>
                    </tr>
                <?php
                $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pagination) : escHtml($pagination); endif; ?>

<?php endif; ?>
</section>
