function tagComponent(nombre, id, selector){
    return `
        <p  id="tag-${id}" data-selector=${selector} data-id=${id}>${nombre}</p>
    `
}
function reloadTags(fun){ 
    document.querySelectorAll(".tag").forEach(tag =>{
        let element =tag.children[0];
        tag.addEventListener("click", ()=>{
            
            document.querySelectorAll(".tag").forEach(tag =>{
                tag.classList.remove("tag--bg")
            });
            
            tag.classList.toggle("tag--bg");

            fun(element);
        })
})
}


export {tagComponent, reloadTags}