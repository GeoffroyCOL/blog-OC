<?php $title = "Ajouter une catégorie"; ?>

<section>
    <header class="mb-3 mb-md-5">
        <h2>Ajouter une catégorie</h2>
    </header>

    <?php require_once __ROOT__ . '/Application/template/message-errors-form.php'; ?>

    <?php if (isset($form)) : ?>
        <div class="my-5">
            <?php escHtml($form); ?>
        </div>
    <?php endif; ?>
</section>