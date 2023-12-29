const hamb = document.querySelector("#hamb");
const popup = document.querySelector("#popup");
const menu1 = document.querySelector("#menu1").cloneNode(1);
const bodu = document.body;

hamb.addEventListener("click", hambHandler);

function hambHandler(e){
    e.preventDefault();
    popup.classList.toggle("open");
    hamb.classList.toggle("active");
    bodu.classList.toggle("noscroll");
    renderPopup();
}

function renderPopup() {
    popup.appendChild(menu1);
}