var editCommentModal = document.getElementById("editCommentModal");
var form = document.getElementById("edit-form");

editCommentModal.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var url = button.getAttribute("data-bs-url");
    var commentId = button.getAttribute("data-id");
    var content = document.getElementById("comment-" + commentId);
    form.setAttribute("action", url);
    document.getElementById("comment-content-js").value = content.textContent;
})
