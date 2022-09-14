async function getData(item,page,limit){
    let data = await fetch(window.location.origin + `/api/getData.php?item=${item}&page=${page}&limit=${limit}`);
    return data.json(); 
}
function renderExpoComponent(id,parent,imgSrc,titulo,info,fav ){
    let render = document.createElement("div");
    render.id = id;
    // render.href = '/home/expo.php?id='+id;

    render.innerHTML = globalThis.expoComponent(imgSrc, titulo, info,id,fav);

    parent.appendChild(render);
}

function renderRecommendComponent(id, parent, imgSrc, titulo, info){
    let render = document.createElement("a");
    render.id = id;
    render.href = '/home/expo.php?id='+id;

    render.innerHTML = globalThis.expoRecommend(imgSrc, titulo, info,id);

    parent.appendChild(render);
}

async function getSearch(search){
    let data = await fetch(window.location.origin+'/api/getData.php?expo-search='+search);
    return data.json();
}
export {getData, renderExpoComponent, renderRecommendComponent, getSearch}