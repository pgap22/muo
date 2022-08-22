import {
    ingles,
    esp
} from "./translate.js";


//Preload
let myDiv, myDivLogo, myImgLogo;
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
window.addEventListener("load", () => {
    loader.classList.add("hide")
})

//Hamburguer Menu Responsive Mobile
let hamburguerMenu = document.querySelector(".header__menu");
if (hamburguerMenu) {
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

}

//Translate
let divTranslate = document.createElement("div");
let imgTransalte = document.createElement("img");
divTranslate.classList.add("translate");
imgTransalte.src = "../img/translate/en.webp";
imgTransalte.classList.add("translate__icon");
divTranslate.appendChild(imgTransalte);
document.querySelector("body").insertBefore(divTranslate, document.querySelector("main"));


let translateClick = document.querySelector(".translate img");
let translateIcon = document.querySelector(".translate");
let pageTranslate = document.querySelector("body").dataset.page;

let lang = sessionStorage.getItem("lang");
if (!lang) {
    sessionStorage.setItem("lang", "es");
    lang = sessionStorage.getItem("lang");
}

if (lang == "en") {
    sessionStorage.setItem("lang", "en");
    lang = "en"
    translate(ingles, pageTranslate);
    translateClick.src = "../img/translate/es.webp"
} else if (lang == "es") {
    sessionStorage.setItem("lang", "es");
    lang = "es"
    translate(esp, pageTranslate);
    translateClick.src = "../img/translate/en.webp"

}

function exceptionTranslate(lang_array, pageTranslate) {
    let exceptWords = Object.keys(lang_array[pageTranslate]);
    exceptWords.forEach((e) => {
        if (e == "credits") {
            if (document.querySelector('#credits')) {
                document.querySelectorAll("#credits").forEach(element => {
                    element.innerHTML = lang_array[pageTranslate][e];
                })
            }

        } else {
            if (document.getElementById(e)) {
                document.getElementById(e).innerHTML = lang_array[pageTranslate][e];
            }
        }
    })
}

function placeHolderTranslate(lang_array, pageTranslate, placeholder) {
    if (document.querySelector("body").dataset.page == pageTranslate) {
        let inputPlaceholder = Object.keys(lang_array[placeholder]);
        inputPlaceholder.forEach(e => {
            document.getElementById(e).placeholder = lang_array[placeholder][e];
        })
    }
}

async function museumTranslate() {
    let museoId = document.querySelector("body").dataset.id;
    let dataMuseum = await fetch('http://localhost/api/getData.php?museoid=' + museoId);

    return dataMuseum.json()
}

async function translate(lang_array, pageTranslate) {
    if (pageTranslate == 'museo-info') {
        museumTranslate().then(e => {
            esp["museo-info"] = [];
            esp["museo-info"]["info"] = e.descripcion;

            ingles["museo-info"] = [];
            ingles["museo-info"]["info"] = e.info_en;

            if (lang_array[pageTranslate]) {
                let words = Object.keys(lang_array[pageTranslate]);
                words.forEach(element => {

                    if (document.getElementById(element)) {
                        document.getElementById(element).innerHTML = lang_array[pageTranslate][element];
                    }


                });
            }
        });
    } else {
        if (lang_array[pageTranslate]) {
            let words = Object.keys(lang_array[pageTranslate]);
            words.forEach(element => {

                if (document.getElementById(element)) {
                    document.getElementById(element).innerHTML = lang_array[pageTranslate][element];
                }


            });
        }
    }



    exceptionTranslate(lang_array, "general")


    placeHolderTranslate(lang_array, "register", "placeholder-register");
    placeHolderTranslate(lang_array, "login", "placeholder-login");
    placeHolderTranslate(lang_array, "recover-pass", "recover-pass-placeholder");
    placeHolderTranslate(lang_array, "set-new-password", "new-password-placeholder");

    await fetch(document.location.origin + "/api/changeLanguage.php?lang=" + lang);


}


translateIcon.addEventListener("click", () => {

    if (lang == "es") {
        sessionStorage.setItem("lang", "en");
        lang = "en"
        translate(ingles, pageTranslate);
        translateClick.src = "../img/translate/es.webp"
    } else if (lang == "en") {
        sessionStorage.setItem("lang", "es");
        lang = "es"
        translate(esp, pageTranslate);
        translateClick.src = "../img/translate/en.webp"

    }
})

//     <div class="translate">
//     <img src="../img/translate/en.webp" alt="" class="translate__icon">
// </div>