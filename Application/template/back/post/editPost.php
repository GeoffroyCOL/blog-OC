<?php $title = "Modifier un post"; ?>

<section>
    <header class="mb-3 mb-md-5">
        <h2>Modifier un post</h2>
    </header>

    <?php require_once __ROOT__ . '/Application/template/message-errors-form.php'; ?>

    <?php
    if ($form) : ?>
        <div class="my-5 row">
            <div class="col-12 col-md-8">
                <?php escHtml($form); ?>
            </div>

            <div class="col-12 col-md-4">
                <img class="img-fluid" src="<?php escHtml($post->getFeatured()->getUrl()) ?>" alt="">
            </div>
        </div>
    <?php endif; ?>
</section>