let optionsMuseum = document.querySelector(".options-museum");
let selectMuseum = document.querySelector(".select-museum");

let itemsMuseum = document.querySelectorAll(".museum-items");
let itemSelectedMuseum = document.querySelector(".main__selected-museum");
let placeholderMuseum = document.querySelector(".placeholder-museum");
let inputMuseum = document.getElementById("select-id-museum");

let optionsCategory = document.querySelector(".options-category");
let selectCategory = document.querySelector(".select-category");

let itemsCategory = document.querySelectorAll(".category-items");
let itemSelectedCategory = document.querySelector(".main__selected-category");
let placeholderCategory = document.querySelector(".placeholder-category");
let inputCategory = document.getElementById("select-id-category");

function selectCustom(options, select, items, itemSelected, placeholder, input) {
    select.addEventListener("click", ()=>{
        toggleOptions();
    })
    
    function toggleOptions(){
        options.classList.toggle("show");
        select.classList.toggle("selected");
        select.classList.remove("errorBorder");
        if(document.querySelector(".select-museum .errorMessage")){
            document.querySelector(".select-museum .errorMessage").remove();
        }
    }
    function setItem(item, oldItem){
        if(placeholder.innerHTML){
            placeholder.innerHTML = '';
        }
        oldItem.innerHTML = item.innerHTML;
    }
    
    items.forEach(item =>{
        item.addEventListener("click", ()=>{
            if(!options.classList.contains("show")) return false;
            toggleOptions();
            input.value = item.id;
            setItem(item.children[0], itemSelected);
        })
    })

    function restoreForm(item){
        toggleOptions();
        input.value = item.id;
        setItem(item.children[0], itemSelected);
        toggleOptions();
    }

    window.addEventListener("load", ()=>{
        if(document.querySelector( "."+options.classList[2]+" .main__items--selected")){
            restoreForm(document.querySelector( "."+options.classList[2]+" .main__items--selected"))
        }
    })
}

selectCustom(optionsMuseum, selectMuseum, itemsMuseum, itemSelectedMuseum, placeholderMuseum, inputMuseum);

selectCustom(optionsCategory, selectCategory, itemsCategory, itemSelectedCategory, placeholderCategory, inputCategory);