<?php $title = "Ajouter un post"; ?>

<section class="row my-8">
    <header class="col-12">
        <h2>Ajouter un post</h2>
    </header>

    <?php if (isset($formErrors)) : ?>
        <div class="toast toast--danger">
            <button class="btn-close"></button>
        <?php foreach($formErrors as $label => $errors) :?>
            <h4 class="toast__title"><?php escHtml($label); ?></h4>
            <?php foreach($errors as $error) :?>
                <p><?php escHtml($error); ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <div class="my-5 col-12">
        <?php escHtml($form); ?>
    </div>
</section>