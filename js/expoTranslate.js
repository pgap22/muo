async function getTranslateinfo(){
    let id = document.querySelector("body").dataset.id;
    let data = await fetch("http://localhost/api/getData.php?id_expo="+id);
    return data.json();
}

getTranslateinfo().then(expo =>{
    globalThis.spanish["expo"] = [];
    globalThis.spanish["expo"]["info"] = expo.informacion;
    globalThis.spanish["expo"]["name"] = expo.nombre;

    globalThis.english["expo"] = [];
    globalThis.english["expo"]["info"] = expo.info_eng;
    globalThis.english["expo"]["name"] = expo.name_eng;

    globalThis.exceptionTranslate(globalThis.getLangArray(), "expo");
})