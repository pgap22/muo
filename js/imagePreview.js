let dragZone = document.querySelector(".main__drag-zone");
let placeholder = document.querySelector(".main__drag-text");

let inputFile = document.getElementById("new_img");
let imgPreview = document.getElementById("preview-img");


document.querySelector("html").addEventListener("dragover", (e)=>{
    e.preventDefault();
})
document.querySelector("html").addEventListener("drop", (e)=>{
    e.preventDefault();
})

dragZone.addEventListener("drop", (e)=>{
    let file = e.dataTransfer.files[0]
    let src = URL.createObjectURL(file);
    updateSrc(src);

    inputFile.files = e.dataTransfer.files;
})

inputFile.addEventListener("change", ()=>{
    let file = inputFile.files[0];
    let src = URL.createObjectURL(file);
    updateSrc(src);
})

function updateSrc(src) {
    imgPreview.src = src;
    placeholder.classList.add("none");
}
