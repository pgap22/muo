async function getData(item,page,limit){
    let data = await fetch(window.location.origin + `/api/getData.php?item=${item}&page=${page}&limit=${limit}`);
    return data.json();
}
function render(id,parent,imgSrc,titulo,info ){
    let render = document.createElement("div");
    render.id = id;

    if(info.split(" ").length > 15){
        info = info.split(" ").slice(0, 15).join(" ")+"...";
    }
    else{
        info = info.split(" ").slice(0, info.split(" ").length-1).join(" ")+"...";
    }

    render.innerHTML = globalThis.expoComponent(imgSrc, titulo, info);

    parent.appendChild(render);

}
export {getData, render}