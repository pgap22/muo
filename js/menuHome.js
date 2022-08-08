let showMenuBtns = document.querySelectorAll(".header__show");
let menu = document.querySelector(".header__options");
let blackScreen = document.querySelector(".header__black-screen");

showMenuBtns.forEach(btn =>{
    btn.addEventListener("click", ()=>{
        menu.classList.toggle("ocultar");
        blackScreen.classList.toggle("show");
    })
})