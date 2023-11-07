//get modal element
var Modal = document.getElementById('m1');

window.onclick = function (event) {
    if (event.target == Modal) {
        Modal.style.display = "none";
    }
}
