let btnForDelete = document.getElementById('btn-delete-js');
let listItemDelete = document.getElementsByClassName('delete-item');

for (let item of listItemDelete) {
    item.addEventListener('click', () => {
        let url = item.getAttribute('data-url');
        btnForDelete.setAttribute('href', url);
    });
}
