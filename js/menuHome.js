let showMenuBtns = document.querySelectorAll(".header__show");


let menu = document.querySelector(".header__options");
let blackScreen = document.querySelector(".header__black-screen");

document.querySelector(".home-menu-toggle").addEventListener("click",()=>{
    menu.classList.toggle("ocultar");
    blackScreen.classList.toggle("show");
    console.log("xd")
})

showMenuBtns.forEach(btn =>{
    btn.addEventListener("click", ()=>{
        if(document.querySelector(".menu__setting-show") && window.screen.width >= 521) return; 
        
        menu.classList.toggle("ocultar");
        blackScreen.classList.toggle("show");
    })


})

if(document.querySelector(".menu__setting-show")){
    let homeButton = document.querySelector(".menu__setting-show");
    homeButton.addEventListener("click", ()=>{
        menu.classList.toggle("ocultar");
        blackScreen.classList.toggle("show");
    })

}