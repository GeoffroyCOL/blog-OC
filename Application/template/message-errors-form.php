<?php if ($formErrors) : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php foreach ($formErrors as $label => $errors) :?>
        <h4> <?php escHtml($label); ?></h4>
        <?php foreach ($errors as $error) :?>
            <p><?php escHtml($error); ?></p>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif;