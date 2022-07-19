import {ingles, esp} from "./translate.js";
//     <div class="preloader">
//     <div class="preloader__logo">
//         <img src="../img/logo/logo.svg" alt="">
//     </div>
// </div>

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
window.addEventListener("load", ()=>{
    loader.classList.add("hide")
})

//Hamburguer Menu Responsive Mobile


    let hamburguerMenu = document.querySelector(".header__menu");
    if(hamburguerMenu){
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
    if(!lang){
        sessionStorage.setItem("lang", "es");
        lang = sessionStorage.getItem("lang");
    }

    if(lang == "en"){
        sessionStorage.setItem("lang", "en");
        lang = "en"
        translate(ingles, pageTranslate);
        translate(ingles, "general");
        translateClick.src = "../img/translate/es.webp"
    }
    else if(lang == "es"){
        sessionStorage.setItem("lang", "es");
        lang = "es"
        translate(esp, pageTranslate);
        translate(esp, "general");
        translateClick.src = "../img/translate/en.webp"

    }


    function translate(lang_array, pageTranslate) {
        let words = Object.keys(lang_array[pageTranslate]);
        words.forEach(element => {
            if(element == "credits"){
                if(document.querySelector('#credits')){
                    document.querySelectorAll("#credits").forEach(e =>{
                        e.innerHTML = lang_array[pageTranslate][element];
                    })
                }
             
            }else{
                if(document.getElementById(element)){
                    document.getElementById(element).innerHTML = lang_array[pageTranslate][element];
                }
                
            }
        });
        
        
        let formsErrors = Object.keys(lang_array["register-error"]);
        let formsErrors_login = Object.keys(lang_array["login-error"]);

        formsErrors.forEach((e)=>{
            if(document.getElementById(e)){
                document.getElementById(e).innerHTML = lang_array["register-error"][e];
            }
        })
        formsErrors_login.forEach((e)=>{
            if(document.getElementById(e)){
                document.getElementById(e).innerHTML = lang_array["login-error"][e];
            }
        })

        if(pageTranslate == "register"){
            let placeholder = Object.keys(lang_array["placeholder-register"]);
            placeholder.forEach(e =>{
                document.getElementById(e).placeholder = lang_array['placeholder-register'][e];
            })
        }
        else if(pageTranslate == "login"){
            let placeholder = Object.keys(lang_array["placeholder-login"]);
            placeholder.forEach(e =>{
                document.getElementById(e).placeholder = lang_array['placeholder-login'][e];
            })
        }
    }


    translateIcon.addEventListener("click", ()=>{
        
        if(lang == "es"){
            sessionStorage.setItem("lang", "en");
            lang = "en"
            translate(ingles, pageTranslate);
            translate(ingles, "general");
            
            translateClick.src = "../img/translate/es.webp"
        }
        else if(lang == "en"){
            sessionStorage.setItem("lang", "es");
            lang = "es"
            translate(esp, pageTranslate);
            translate(esp, "general");

            translateClick.src = "../img/translate/en.webp"

        }
    })

//     <div class="translate">
//     <img src="../img/translate/en.webp" alt="" class="translate__icon">
// </div>
