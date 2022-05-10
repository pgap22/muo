//Hamburguer Menu Responsive Mobile

let hamburguerMenu = document.querySelector(".header__menu");
let menuNav = document.querySelector(".nav");
let closeHamburguer = document.querySelector(".nav__closeMenu");
let blackScreen = document.querySelector(".header__blackScreen")
closeHamburguer.style.visibility = "hidden";

function showMenu(){
    menuNav.style.transform = "translateX(0%)";
    blackScreen.style.display = "block";
    hamburguerMenu.style.visibility = "hidden";
    closeHamburguer.style.visibility = "visible";
}
function quitMenu(){
    menuNav.style.transform = "translateX(-100%)";
    blackScreen.style.display = "none";
    hamburguerMenu.style.opacity = 1;
    hamburguerMenu.style.display = "block";
    closeHamburguer.style.visibility = "hidden";
    hamburguerMenu.style.visibility = "visible";    
}

hamburguerMenu.addEventListener("click", ()=>{
showMenu()

})
closeHamburguer.addEventListener("click", ()=>{
quitMenu()
})
blackScreen.addEventListener("click", ()=>{
    quitMenu();
})

//Tablet BreakPoint
let icono = document.querySelector(".header__logo")

window.addEventListener("resize", ()=>{
    console.log();
    (window.visualViewport.width >=769) ? showMenu() & (hamburguerMenu.style.display = "none" ) & (blackScreen.style.display = "none") & (menuNav.style.transition = "none") : quitMenu() & (setTimeout(() => {(menuNav.style.transition = "ease-in 200ms")}, 100));
})