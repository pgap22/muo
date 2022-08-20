let page = 1;
let limit = 2;
let parentElement = document.querySelector(".main__feed");



globalThis.getData('expo', page, limit).then(expos =>{
    page++
    expos.forEach(item => {
        globalThis.render(item.id, parentElement, item.imagen, item.nombre, item.informacion);
    });
})



window.addEventListener("scroll", (e)=>{
    if(window.scrollY+window.innerHeight >= document.querySelector("body").offsetHeight){

        globalThis.getData('expo', page, limit).then(expos =>{
            page++
            expos.forEach(item => {
                globalThis.render(item.id, parentElement, item.imagen, item.nombre, item.informacion);
            });
        })
    
    }
})