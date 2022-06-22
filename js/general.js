
//     <div class="preloader">
//     <div class="preloader__logo">
//         <img src="../img/logo/logo.svg" alt="">
//     </div>
// </div>

//Preload
myDiv = document.createElement("div");
myDiv.classList.add("preloader");
myDivLogo = document.createElement("div")
myDivLogo.classList.add("preloader__logo");
myImgLogo = document.createElement("img")
myImgLogo.src = "../img/logo/logo.svg";
document.querySelector("body").insertBefore(myDiv, document.querySelector("body").firstChild);
document.querySelector(".preloader").appendChild(myDivLogo)
document.querySelector(".preloader__logo").appendChild(myImgLogo);
let loader = document.querySelector(".preloader");
window.addEventListener("load", ()=>{
    loader.classList.add("hide")
})


//Hamburguer Menu Responsive Mobile


    let hamburguerMenu = document.querySelector(".header__menu");
    let menuNav = document.querySelector(".nav");
    let closeHamburguer = document.querySelector(".nav__close-menu");
    let blackScreen = document.querySelector(".header__black-screen");

    function showMenu() {
        hamburguerMenu.classList.add("hideIcon");
        menuNav.classList.add("showMenu");
        closeHamburguer.classList.add("showCloseMenu")
        blackScreen.classList.add("showBlackScreen")
    }
    function quitMenu() {
        hamburguerMenu.classList.remove("hideIcon");
        menuNav.classList.remove("showMenu");
        closeHamburguer.classList.remove("showCloseMenu")
        blackScreen.classList.remove("showBlackScreen")
    }

hamburguerMenu.addEventListener("click", () => {
 showMenu();
})
closeHamburguer.addEventListener("click", () => {
    quitMenu()
})
blackScreen.addEventListener("click", () => {
    quitMenu()
})
