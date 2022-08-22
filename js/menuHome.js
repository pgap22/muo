let showMenuBtns = document.querySelectorAll(".header__show");


let menu = document.querySelector(".header__options");
let blackScreen = document.querySelector(".header__black-screen");


//Cancel Button
document.querySelector(".home-menu-toggle").addEventListener("click", toggleMenu);

//Dots Button
showMenuBtns.forEach(btn =>{
    btn.addEventListener("click", ()=>{
        if(document.querySelector(".menu__setting-show") && window.innerWidth >= 519) return; 
        
        document.querySelector(".header__pages").innerHTML = globalThis.menuComponent();
        globalThis.startLang(globalThis.spanish, globalThis.english);
        
        toggleMenu();
    })


})

//Settings Home Button
if(document.querySelector(".menu__setting-show")){
    let homeButton = document.querySelector(".menu__setting-show");
    homeButton.addEventListener("click", ()=>{

        document.querySelector(".header__pages").innerHTML = globalThis.menuComponent();
        globalThis.startLang(globalThis.spanish, globalThis.english);
        
        toggleMenu();
    })

}

function toggleMenu() {
    menu.classList.toggle("ocultar");
    blackScreen.classList.toggle("show");
    
    //Show Settings
    if(document.querySelector(".settings-click")){
        document.querySelector(".settings-click").addEventListener("click", ()=>{
            document.querySelector(".header__pages").innerHTML = globalThis.settingsHomeComponent();  
            document.querySelector(".header__lang").innerHTML = globalThis.langComponent();
            globalThis.startLang(globalThis.spanish, globalThis.english);
        })
    }
}

//Auto Traduction
globalThis.startLang(globalThis.spanish, globalThis.english);
//Settings Button
