
//     <div class="preloader">
//     <div class="preloader__logo">
//         <img src="../img/logo/logo.svg" alt=""> 
//     </div>
// </div>

//Preload
myDiv = document.createElement("div");
myDiv.classList.add("preloader");

myPicture = document.createElement("picture")
myPicture.classList.add("preloader__logo")

myImgLogo = document.createElement("img")
myImgLogo.setAttribute("src", "../img/logo/logo.svg") 


myImgBreakPoint = document.createElement("source")
myImgBreakPoint.setAttribute("srcset", "../img/logo/logo-mobile.svg");
myImgBreakPoint.setAttribute("media", "(max-width: 768px)");

myPicture.appendChild(myImgBreakPoint)
myPicture.appendChild(myImgLogo)

myDiv.appendChild(myPicture)


console.log(myDiv)

document.querySelector("body").insertBefore(myDiv, document.querySelector("body").firstChild);

let loader = document.querySelector(".preloader");
window.addEventListener("load", ()=>{
    loader.classList.add("hide")
})


//Hamburguer Menu Responsive Mobile


    let hamburguerMenu = document.querySelector(".header__menu");
    let menuNav = document.querySelector(".nav");
    let closeHamburguer = document.querySelector(".nav__closeMenu");
    let blackScreen = document.querySelector(".header__blackScreen");

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
