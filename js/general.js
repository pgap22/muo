
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
