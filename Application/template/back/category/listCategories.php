<?php $title = "Liste des catégories"; ?>

<section>
    <header class="mb-3 mb-md-5">
        <h2>Liste des catégories</h2>
        <a class="btn-primary btn-sm btn" href="/admin/category/add">+</a>
    </feader>

<?php if ($categories) : ?>
    <div class="my-5 table-responsive">
        <table class="table">
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
                            <a 
                                class="btn btn-danger btn-sm delete-item" 
                                href="#delete-modal" 
                                data-bs-url="/admin/category/delete/<?php escHtml($category->getId()) ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-entity="cette catégorie" >
                                Supprimer
                            </a>
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
