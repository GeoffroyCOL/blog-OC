<?php //Modal pour demander la confirmation d'une suppression ?>

<div class="modal" id="delete-modal">
    <a href="#" class="modal-overlay close-btn" aria-label="Close"></a>
    <div class="modal-content" role="document">
        <div class="modal-header"><a href="#components" class="u-pull-right" aria-label="Close"><span class="icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11 fa-wrapper" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></span></a>
            <div class="modal-title">Suppression ?</div>
        </div>

        <div class="modal-body">
            Confirmation de la supprresion ?
        </div>

        <div class="modal-footer rtl">
            <a id="btn-delete-js" class="btn btn-danger">Oui</a>
            <a href="#" class="btn outline btn-link" aria-label="Close">Non</a>
        </div>
    </div>
</div>