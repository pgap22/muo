
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
let closeHamburguer = document.querySelector(".nav__closeMenu");
let blackScreen = document.querySelector(".header__blackScreen");
closeHamburguer.style.visibility = "hidden";

function showMenu() {
    menuNav.style.transform = "translateX(0%)";
    blackScreen.style.display = "block";
    hamburguerMenu.style.visibility = "hidden";
    closeHamburguer.style.visibility = "visible";
}

function quitMenu() {
    menuNav.style.transform = "translateX(-100%)";
    blackScreen.style.display = "none";
    hamburguerMenu.style.opacity = 1;
    hamburguerMenu.style.display = "block";
    closeHamburguer.style.visibility = "hidden";
    hamburguerMenu.style.visibility = "visible";
}

hamburguerMenu.addEventListener("click", () => {
    showMenu()

})
closeHamburguer.addEventListener("click", () => {
    quitMenu()
})
blackScreen.addEventListener("click", () => {
    quitMenu();
})

//Tablet BreakPoint
let icono = document.querySelector(".header__logo");
//Footer icon breakpoint
let footerIcon = document.querySelector(".footer__logo")

function restoreChanges(params) {
    if (window.innerWidth >= 742) {
        console.log("menu mostrado TABLET/DESKTOP");
        showMenu();
        hamburguerMenu.style.display = "none";
        blackScreen.style.display = "none";
        menuNav.style.transition = "none";
        footerIcon.src = "../img/logo/logo-bw.svg"
 
    } else {
        // console.log("menu ocultado SMARTPHONE");

        quitMenu()
        setTimeout(() => {
            menuNav.style.transition = "ease-in 200ms"
        }, 100)


		//Add footer img mobil
		footerIcon.src = "../img/logo/logo-mobile-bw.svg"

    }
}
restoreChanges();
window.addEventListener("resize", restoreChanges)