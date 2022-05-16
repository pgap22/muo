//Preload
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


//Restore Breakpoints Styles
function restoreChanges(params) {
    if (window.innerWidth >= 742) {
        console.log("menu mostrado TABLET/DESKTOP");
        showMenu();
        hamburguerMenu.style.display = "none";
        blackScreen.style.display = "none";
        menuNav.style.transition = "none";

        //Eliminar Ancla
        let myToolTips = document.getElementsByClassName("tooltip")
        for (let i = 0; i < myToolTips.length; i++) {
            myToolTips[i].removeAttribute("href")
        }

    } else {
        // console.log("menu ocultado SMARTPHONE");

        quitMenu()
        setTimeout(() => {
            menuNav.style.transition = "ease-in 200ms"
        }, 100)

        //Añadir Ancla
        let myToolTips = document.getElementsByClassName("tooltip")
        for (let i = 0; i < myToolTips.length; i++) {
            myToolTips[i].setAttribute("href", 'https://www.flickr.com/people/camaro27')
        }

    }
}
restoreChanges();
window.addEventListener("resize", () => {
    // console.log(window.innerWidth);
    if (window.innerWidth >= 742) {
        console.log("menu mostrado TABLET/DESKTOP");
        showMenu();
        hamburguerMenu.style.display = "none";
        blackScreen.style.display = "none";
        menuNav.style.transition = "none";

        //quit the link
        let myToolTips = document.getElementsByClassName("tooltip")
        for (let i = 0; i < myToolTips.length; i++) {
            myToolTips[i].removeAttribute("href")
        }

    } else {
        // console.log("menu ocultado SMARTPHONE");

        quitMenu()
        setTimeout(() => {
            menuNav.style.transition = "ease-in 200ms"
        }, 100)

        //added a link
        let myToolTips = document.getElementsByClassName("tooltip")
        for (let i = 0; i < myToolTips.length; i++) {
            myToolTips[i].setAttribute("href", "https://www.flickr.com/people/camaro27")
        }

    }


})


//Carusel :DDDDD

let checkedFirst = document.querySelector(".our-content__btns").children[0].checked=true;
function firstScroll(params) {
    document.querySelector(".our-content__carusel").style.transform = "translateX(-0%)";
}
function secondScroll(params) {
    document.querySelector(".our-content__carusel").style.transform = "translateX(-25%)";
}
function thirdScroll(params) {
    document.querySelector(".our-content__carusel").style.transform = "translateX(-50%)";
}
function fourthScroll(params) {
    document.querySelector(".our-content__carusel").style.transform = "translateX(-75%)";
}
