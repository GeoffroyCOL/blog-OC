let toast = document.getElementById("toast");
let btnToast = document.querySelector("#toast .btn-close");

btnToast.addEventListener("click", () => {
    toast.remove();
});