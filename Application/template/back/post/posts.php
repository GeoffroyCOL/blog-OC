<?php $title = "Liste des articles"; ?>

<section>
    <header class="mb-3 mb-md-5">
        <h2>Liste des articles</h2>
        <a class="btn-primary btn btn-sm" href="/admin/post/add">+</a>
    </header>

<?php if ($posts) : ?>
    <div class="my-5 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>titre</th>
                    <th>Catégorie</th>
                    <th>Supprimer</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1 + ($numberPostPerPage * ($numeroPage - 1));
                foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php escHtml($i) ?></td>
                        <td><a href="/admin/post/edit/<?php escHtml($post->getId()) ?>"><?php escHtml($post->getTitle()) ?></a></td>
                        <td><?php escHtml($post->getCategory()->getName()) ?></td>
                        <td>
                            <a  class="btn btn-danger btn-sm delete-item" 
                                href="#delete-modal" 
                                data-bs-url="/admin/post/delete/<?php escHtml($post->getId()) ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-entity="cet article" >
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

    <?php if ($pagination) : escHtml($pagination); endif;

endif; ?>

</section>
