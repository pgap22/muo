let searchBtn = document.querySelector(".menu-phone-search");
let isEvent = false;

if(window.innerWidth <= 520 ){    
    searchCode();
    isEvent = true;
}

window.addEventListener("resize", (e)=> {
    if(window.innerWidth <= 520 ){    
        searchCode();
        isEvent = true;
    }
})


function searchCode(){
    if(!isEvent){
        searchBtn.addEventListener("click", ()=>{
            renderSearch();
        })
    }
}


function renderSearch(){
    let searchComponent = document.createElement("form");

    searchComponent.action  = "/home/search.php";

    searchComponent.innerHTML = globalThis.searchComponent();

    document.querySelector("body").appendChild(searchComponent);
    
    globalThis.searchLoadEvent();
}