let switchSelector = document.querySelector(".switch");
let ball = document.querySelector(".switch__ball");
let parentElement = document.querySelector(".tags");
let resultContainer = document.querySelector(".result-explore");
let selector = '';
getSelector('0').then(data => {setTags(data)})

async function getSelector(id){
    selector = (id == '1') ? "museum" : "category";
    
    let data  = await fetch("http://localhost/api/getData.php?selector="+selector);
    return data.json();
}


switchSelector.addEventListener("click", ()=>{
    ball.classList.toggle("switch__ball--true");

    if(parseInt(switchSelector.id)){
        switchSelector.id = 0;
    }else{
        switchSelector.id = 1;
    }
    getSelector(switchSelector.id).then(data =>{setTags(data)})
})

function setTags(data){
    //Limpiar tags antiguas
    parentElement.innerHTML = ''
    data.forEach((element, i) => {

        //Translate
        let nombre = '';
        globalThis.spanish["explore"]["tag-"+element.id] = element.nombre;
        if(element.nombre_en){
            
            globalThis.english["explore"]["tag-"+element.id] = element.nombre_en;

            if(sessionStorage.getItem("lang") == 'en'){
                nombre = element.nombre_en;
            }else{
                nombre = element.nombre
            }
        }
        else{
            nombre = element.nombre;
        }

        //Render
        let tag = document.createElement("div");
        tag.classList.add("tag");
        tag.innerHTML = globalThis.tagComponent(nombre, element.id, selector);
        parentElement.appendChild(tag);
        
        //Click Event
        if(i == data.length-1){
            globalThis.reloadTags(showData);
        }
    
    });
}


async function getExpos(s, i){
    let data = await fetch('http://localhost/api/getData.php?explore='+s+'&explore_id='+i);
    return data.json();
}

function showData(e) {
    let selector = e.dataset.selector;
    let id = e.dataset.id;

    getExpos(selector, id).then(data =>{
        resultContainer.innerHTML = '';
        if(!data){
            resultContainer.innerHTML = "No data :(";
            return true;
        }

        if(data){
            data.forEach(expo =>{
                let expoDiscover = document.createElement("a");


                expoDiscover.href = "/home/expo.php?id="+expo.id;

                expoDiscover.innerHTML = globalThis.expoDiscoverComponent(expo.id, expo.nombre, expo.imagen);

                resultContainer.appendChild(expoDiscover);
            })
        }
        

    })
   
}