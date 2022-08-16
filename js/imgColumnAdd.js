let imgComponent = document.getElementById("img-set-expo").content
let addImgComponent = document.getElementById("add-img-expo").content
let imgColumnComponent = document.getElementById("img-column").content

let imgGallery = document.querySelector(".main__img-container");

let imgID = -1;

function setNewAdd(){
    let galley = document.querySelector(".main__column-image");
    galley.appendChild(addImgComponent.cloneNode(1));
}

//If not exist a imgColumm add it
if(!document.querySelector(".main__column-image")){
    imgGallery.appendChild(imgColumnComponent.cloneNode(1));
    setNewAdd();
}

//Avoid new tab in drop img
document.querySelector("html").addEventListener("dragover", (e)=>{
    e.preventDefault();
})
document.querySelector("html").addEventListener("drop", (e)=>{
    e.preventDefault();
})

//Detect new drop img
document.querySelector(".main__img--add").addEventListener("drop", (e)=>{
    addImg(e.dataTransfer.files[0]);

})

//Detect upload img via input
document.getElementById("img-expo").addEventListener("change", (e)=>{
    addImg(document.getElementById("img-expo").files[0]);
})



function addImg(imgFile){
    let src = URL.createObjectURL(imgFile);
    let imgAdd = imgComponent.cloneNode(1);
    
    imgID = imgID + 1; 
    let inputImg = imgAdd.children.item(0).children[2];
    
    inputImg.id = "img-"+imgID;
    inputImg.name = "img-"+imgID;

    
    imgAdd.children[0].children[0].src = src;

    let dataFiles = new DataTransfer();

    dataFiles.items.add(imgFile);

    inputImg.files = dataFiles.files;

    document.querySelector(".main__column-image").appendChild(imgAdd);

    document.querySelector(".main__column-image").classList.remove("errorBorder");
    document.querySelector(".main__img--add").classList.remove("errorBorder");
    
    if(document.querySelector(".errorMessage")){
        document.querySelector(".errorMessage").remove();
    }

}

//Detect quit image
function quitImage(element) {
    element.parentElement.remove();
    imgID = imgID-1;
    document.querySelectorAll("div.main__img-wrapper").forEach((element, i) =>{
        element.id = i;
    })
}

