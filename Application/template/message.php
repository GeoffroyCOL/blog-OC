<?php
    $messages = showMessageFlash();

    $listMessages = [
        'danger'    => 'Erreur',
        'info'      => 'Information',
        'success'   => 'Bravo'
    ];

    if (! empty($messages)) :
        foreach ($messages as $status => $message) : ?>
            <div class="toast toast--<?php escHtml($status); ?>">
                <button class="btn-close"></button>
                <h4 class="toast__title"><?php escHtml($listMessages[$status]); ?></h4>
                <p><?php escHtml($message); ?></p>
            </div>
        <?php endforeach;
    endif;