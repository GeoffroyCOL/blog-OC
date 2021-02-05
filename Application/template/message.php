<?php
    
$messages = showMessageFlash();

$responses = [
    'success' => [
        'icon'  => '<i class="fas fa-check"></i>',
        'color' => 'bg-success',
        'title' => 'Félicitation'
    ],
    'error' => [
        'icon'  => '<i class="fas fa-times"></i>',
        'color' => 'bg-danger',
        'title' => 'Erreur'
    ],
    'info' => [
        'icon'  => '<i class="fas fa-info"></i>',
        'color' => 'bg-info',
        'title' => 'Information'
    ]
];

if (! empty($messages)) :
    foreach ($messages as $status => $message) : ?>
    <div id="toast" class="top-50 start-100 translate-middle position-absolute z-index">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-white <?php escHtml($responses[$status]['color']); ?>">
                <?php escHtml($responses[$status]['icon']); ?>
                <strong class="me-auto ms-2"><?php escHtml($responses[$status]['title']); ?></strong>
                <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php escHtml($message); ?>
            </div>
        </div>
    </div>
    <?php endforeach;
endif; ?>