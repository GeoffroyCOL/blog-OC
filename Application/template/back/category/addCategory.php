<?php $title = "Ajouter une catégoties"; ?>

<section>
    <h2>Ajouter une catégorie</h2>
</section>

<?php require_once __ROOT__ . '/Application/template/message-errors-form.php'; ?>

<?php if (isset($form)) : ?>
    <div class="my-5">
        <?php escHtml($form); ?>
    </div>
<?php endif; 