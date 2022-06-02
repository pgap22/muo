//Preload
// let loader = document.querySelector(".preloader");
// window.addEventListener("load", ()=>{
//     loader.classList.add("hide")
// })




//Restore Breakpoints Styles
function restoreChanges(params) {
    if (window.innerWidth >= 742) {
        console.log("menu mostrado TABLET/DESKTOP");
        showMenu();
        hamburguerMenu.style.display = "none";
        blackScreen.style.display = "none";
        menuNav.style.transition = "none";
        footerIcon.src = "../img/logo/logo-bw.svg"
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
		//Add footer img mobil
		footerIcon.src = "../img/logo/logo-mobile-bw.svg"

    }
}
restoreChanges();
window.addEventListener("resize", restoreChanges)


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
