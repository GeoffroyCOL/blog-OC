let toast = document.getElementById("toast");
let btnToast = document.querySelector("#toast .btn-close");

if (btnToast) {
    btnToast.addEventListener("click", () => {
        toast.remove();
    });
}