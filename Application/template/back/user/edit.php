<?php $title = "Modifier votre profil" ?>

<section>
    <header class="mb-3 mb-md-5">
        <h2>Modifier votre profil</h2>
    </header>

    <?php require_once __ROOT__ . '/Application/template/message-errors-form.php'; ?>

    <?php if($form) : ?>
        <div>
            <?php escHtml($form); ?>
        </div>
    <?php endif; ?>
</section>