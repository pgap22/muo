let tags = document.querySelectorAll(".tag-category");

tags.forEach(data =>{
    let tag = data.children[0];
    let esp = tag.dataset.esp; 
    let eng = tag.dataset.eng
    let id = tag.dataset.id;
    globalThis.spanish["explore"]["category-"+id] = esp; 
    globalThis.english["explore"]["category-"+id] = eng;
    globalThis.startLang(globalThis.spanish, globalThis.english);
})