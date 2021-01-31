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