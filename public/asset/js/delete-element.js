var deleteModal = document.getElementById("deleteModal");

deleteModal.addEventListener("show.bs.modal", function (event) {
    var button = event.relatedTarget;
    var url = button.getAttribute("data-bs-url");
    var entity = button.getAttribute("data-entity");

    document.getElementById("entity-js").textContent = entity + " ?";
    document.getElementById("btn-delete-js").setAttribute("href", url);
})
