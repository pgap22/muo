let contentMision = document.querySelector(".mision");
let contentVision = document.querySelector(".vision")
let contentPersonal = document.querySelector(".personal")
let allContent = document.querySelector(".our__content").children;

(window.screen.availWidth >= 742) ? contentMision.style.display = "grid" : contentMision.style.display = "flex";
contentMision.classList.add("current")

function showContent(element) {
    switch (element.id) {
        case "mision": hideOthers(contentMision);  
            break;
        case "vision": hideOthers(contentVision);
            break;
        case "personal": hideOthers(contentPersonal);
            break;

    }
}
function hideOthers(currentContent) {
        for (let i = 0; i < allContent.length; i++) {
            const element = allContent[i];
            if(currentContent.className != element.className){
                element.style.display = "none";
                element.classList.remove("current");
            } 
            else{
                element.classList.add("current");
                (window.screen.availWidth > 741) ? element.style.display = "grid" : element.style.display = "flex";
            }
       }
}

//Restore Breakpoints Styles
function restoreChanges(params) {
    if (window.innerWidth >= 742) {
        document.querySelector(".current").style.display = "grid";
    } else {
        document.querySelector(".current").style.display = "flex";
    }
}
restoreChanges();
window.addEventListener("resize", restoreChanges)