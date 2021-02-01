<?php $title = "Ajouter un post"; ?>

<section class="row my-8">
    <header class="col-12">
        <h2>Ajouter un post</h2>
    </header>

    <?php require_once __ROOT__ . '/Application/template/message-errors-form.php'; ?>

    <div class="my-5 col-12">
        <?php escHtml($form); ?>
    </div>
</section>