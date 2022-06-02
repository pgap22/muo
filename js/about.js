let contentMision = document.querySelector(".mision")
contentMision.style.display = "flex";
let contentVision = document.querySelector(".vision")
let contentPersonal = document.querySelector(".personal")
let allContent = document.querySelector(".our__content").children;

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
                console.log(element)
            } 
            else{
                element.style.display = "flex";
            }
        }
}