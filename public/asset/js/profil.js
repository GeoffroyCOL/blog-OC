let tabsContent = document.getElementsByClassName("tab-item-content");

for (let item of tabsContent) {
    let name = item.parentNode.getAttribute("data-name");

    item.addEventListener("click", (e) => {
        toggleClassTab(item.parentNode);
        console.log(item.parentNode.getAttribute("data-name"));
    });
}

function toggleClassTab(item)
{
    for (let element of tabsContent) {
        element.parentNode.classList.remove("selected");
        if (element.parentNode == item) {
            item.classList.add("selected")
        }
    }
}