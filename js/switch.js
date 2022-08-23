let allTags = document.querySelectorAll(".tag");
let switchBtn = document.querySelector(".switch"); 
let switchBall = document.querySelector(".switch__ball");
let tagsContainer = document.querySelectorAll(".tags");
let selector = switchBtn.id;
let resultContainer = document.querySelector(".result-explore");

switchBtn.addEventListener("click", ()=>{
    switchBall.classList.toggle("switch__ball--true");
    
    tagsContainer.forEach(tag => {
        if(tag.classList.contains("hide-tags")){
            tag.classList.remove("hide-tags");
        }
        else{
            tag.classList.add("hide-tags");
        }
    })


});


async function getData(selector, id){
    let data = await fetch(window.location.origin+"/api/getData.php?explore="+selector+"&explore_id="+id);
    return data.json();
}


allTags.forEach(tag => {
    tag.addEventListener("click", ()=> {
        allTags.forEach(element => {
            element.classList.remove("tag--bg");
        })

        tag.classList.add("tag--bg");

        let exploreSelector = tag.children[0].dataset.selector;
        let exploreId = tag.children[0].dataset.id;

        getData(exploreSelector, exploreId).then(results => {
            resultContainer.innerHTML = '';
            
            if(!results) {
                resultContainer.innerHTML = "No data :(";
                return true;
            }

            results.forEach(discoverExpo => {
                let expo = document.createElement("a");
                expo.href = "/home/expo.php?id="+discoverExpo.id;

                expo.innerHTML = globalThis.expoDiscoverComponent(discoverExpo.id, discoverExpo.nombre, discoverExpo.imagen);

                resultContainer.appendChild(expo);
            })
        });

    })
}) 