<?php $title = "Liste des catégories"; ?>

<h2>Liste des catégories</h2>

<a href="/admin/category/add">Ajouter</a>

<?php if ($categories) : ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Pseudo</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i = 1;
        foreach ($categories as $category) : ?>
            <tr>
                <td><?php escHtml($i) ?></td>
                <td><?php escHtml($category->getName()) ?></td>
                <td>
                    <a href="/admin/category/edit/<?php escHtml($category->getId()) ?>">Modifier</a>
                </td>
            </tr>
        <?php
        $i++;
        endforeach; ?>
    </tbody>
</table>
<?php endif;