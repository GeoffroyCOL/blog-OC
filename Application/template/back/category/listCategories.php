<?php $title = "Liste des catégories"; ?>

<section class="row my-8">
    <header class="col-12">
        <h2 class="headline-5">Liste des catégories</h2>
    </feader>

<p><a class="btn-link btn" href="/admin/category/add">Ajouter</a></p>

<?php if ($categories) : ?>
<div class="my-5">
    <table class="table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Pseudo</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $i = 1 + ($numberPostPerPage * ($numeroPage - 1));
            foreach ($categories as $category) : ?>
                <tr>
                    <td><?php escHtml($i) ?></td>
                    <td><a href="/admin/category/edit/<?php escHtml($category->getId()) ?>"><?php escHtml($category->getName()) ?></a></td>
                    <td>
                        <a class="btn btn-danger delete-item" href="#delete-modal" data-url="/admin/category/delete/<?php escHtml($category->getId()) ?>"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php
            $i++;
            endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($pagination) : escHtml($pagination); endif; ?>

<?php endif;
