<?php $title = "Liste des commentaires"; ?>

<h2>Liste des commentaires</h2>

<?php if ($comments) : ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Commentaire</th>
            <th>Auteur</th>
            <th>Article</th>
            <th>Valider</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i = 1;
        foreach ($comments as $comment) : ?>
            <tr>
                <td><?php escHtml($i) ?></td>
                <td><?php escHtml($comment->getContent()) ?></a></td>
                <td><?php escHtml($comment->getAutor()->getPseudo()) ?></td>
                <td><?php escHtml($comment->getPost()->getTitle()) ?></td>
                <td>
                    <?php if ($comment->getIsValide() == 0):?><a href="/admin/comment/valide/<?php escHtml($comment->getId()) ?>">Oui</a><?php endif; ?>
                    <a href="/admin/comment/delete/<?php escHtml($comment->getId()) ?>">Non</a>
                </td>
            </tr>
        <?php
        $i++;
        endforeach; ?>
    </tbody>
</table>
<?php endif;
