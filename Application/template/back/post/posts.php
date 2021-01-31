<?php $title = "Liste des articles"; ?>

<section class="row my-8">
    <header class="col-12">
        <h2 class="headline-5">Liste des articles</h2>
    </feader>

<p><a class="btn-link btn" href="/admin/post/add">Ajouter</a></p>

<?php if ($posts) : ?>
    <div class="my-5">
        <table class="table striped">
            <thead>
                <tr>
                    <th class="u-none-xs">#</th>
                    <th>titre</th>
                    <th class="u-none-xs">Catégorie</th>
                    <th>Supprimer</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1 + ($numberPostPerPage * ($numeroPage - 1));
                foreach ($posts as $post) : ?>
                    <tr>
                        <td class="u-none-xs"><?php escHtml($i) ?></td>
                        <td><a href="/admin/post/edit/<?php escHtml($post->getId()) ?>"><?php escHtml($post->getTitle()) ?></a></td>
                        <td class="u-none-xs"><?php escHtml($post->getCategory()->getName()) ?></td>
                        <td>
                            <a class="btn btn-danger delete-item" href="#delete-modal" data-url="/admin/post/delete/<?php escHtml($post->getId()) ?>"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php
                $i++;
                endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pagination) : escHtml($pagination); endif;

endif; ?>

</section>
