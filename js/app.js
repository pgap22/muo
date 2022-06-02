//Carusel :DDDDD


let art = document.querySelector(".our-content__btns.art ").children[0]
let miliar = document.querySelector(".our-content__btns.militar").children[0]
let ciencia = document.querySelector(".our-content__btns.ciencia").children[0]

art.checked = true;
miliar.checked = true;
ciencia.checked = true;
function firstScroll(e) {
    console.log();
    e.parentElement.parentElement.children[0].children[0].style.transform = "translateX(-0%)";
}

function secondScroll(e) {
    console.log();
    e.parentElement.parentElement.children[0].children[0].style.transform = "translateX(-25%)";
}
function thirdScroll(e) {
    console.log();
    e.parentElement.parentElement.children[0].children[0].style.transform = "translateX(-50%)";
}
function fourthScroll(e) {
    console.log();
    e.parentElement.parentElement.children[0].children[0].style.transform = "translateX(-75%)";
}
