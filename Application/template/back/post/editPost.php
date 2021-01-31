<?php $title = "Modifier un post"; ?>

<section class="row my-8">
    <header class="col-12">
        <h2>Modifier un post</h2>
    </header>

    <?php if ($formErrors) : ?>
        <div class="toast toast--danger">
            <button class="btn-close"></button>
        <?php foreach ($formErrors as $label => $errors) :?>
            <h4 class="toast__title"><?php escHtml($label); ?></h4>
            <?php foreach ($errors as $error) :?>
                <p><?php escHtml($error); ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php

    if ($form) : ?>
        <div class="my-5 col-xs-12 col-md-8">
            <?php escHtml($form); ?>
        </div>

        <div class="col-xs-12 col-md-4">
            <img src="<?php escHtml($post->getFeatured()->getUrl()) ?>" alt="">
        </div>
    <?php endif; ?>
</section>