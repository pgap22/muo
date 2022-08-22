function loadBtn(position) {
    let otherImg = document.querySelectorAll(".carusel-expo__other-img");

    if(!otherImg[position-1]){
        document.querySelector(".carusel-expo__back").classList.add("btn-hide");
    }
    else{
        document.querySelector(".carusel-expo__back").classList.remove("btn-hide");
    }

    if(!otherImg[position+1]){
        document.querySelector(".carusel-expo__next").classList.add("btn-hide");
    }
    else{
        document.querySelector(".carusel-expo__next").classList.remove("btn-hide");
    }

}
function loadFirstImage() {
    let img = document.querySelector(".carusel-expo__more-img").children[0];
    let primaryImg = document.querySelector(".carusel-expo__img");
    if(img){
        primaryImg.src = img.src;
        loadBtn(0);
    }
}

function setImage(img, position) {
    document.querySelector(".carusel-expo__img").src = img.src;
    document.querySelector(".carusel-expo__img").dataset.position = position;
    loadBtn(position); 
}

function back(){
    let otherImg = document.querySelectorAll(".carusel-expo__other-img");
    let position = parseInt(document.querySelector(".carusel-expo__img").dataset.position);

    if(otherImg[position-1]){
        setImage(otherImg[position-1], position-1);
    }

}
function next(){
    let otherImg = document.querySelectorAll(".carusel-expo__other-img");
    let position = parseInt(document.querySelector(".carusel-expo__img").dataset.position);
    
    if(otherImg[position+1]){
        setImage(otherImg[position+1], position+1);
    }
}

loadFirstImage();