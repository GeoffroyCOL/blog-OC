<?php $title = "Liste des articles"; ?>

<h2>Liste des articles</h2>

<a href="/admin/post/add">Ajouter un article</a>

<?php if ($posts) : ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>titre</th>
            <th>Catégory</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i = 1;
        foreach ($posts as $post) : ?>
            <tr>
                <td><?php escHtml($i) ?></td>
                <td><?php escHtml($post->getTitle()) ?></a></td>
                <td><?php escHtml($post->getCategory()->getName()) ?></td>
                <td>
                    <a href="/admin/post/edit/<?php escHtml($post->getId()) ?>">Modifier</a>
                    <a href="/admin/post/delete/<?php escHtml($post->getId()) ?>">Supprimer</a>
                </td>
            </tr>
        <?php
        $i++;
        endforeach; ?>
    </tbody>
</table>
<?php endif;
