<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Modification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" method="POST">
                    <div class="mb-3">
                        <label for="content" class="col-form-label mb-0 fw-bold">Votre commentaire</label>
                        <textarea id="comment-content-js" class="form-control" name="content" id="content" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="text-uppercase btn-sm btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
