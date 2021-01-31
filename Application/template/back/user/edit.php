<?php $title = "Modifier votre profil" ?>

<section my-8>
    <header>
        <h2>Modifier votre profil</h2>
    </header>

    <?php require_once dirname(__DIR__, 2) . '/message-errors-form.php'; ?>

    <?php if($form) : ?>
    <div class="my-5">
        <?php escHtml($form); ?>
    </div>
    <?php endif; ?>
</section>