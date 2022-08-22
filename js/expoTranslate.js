async function getTranslateinfo(){
    let id = document.querySelector("body").dataset.id;
    let data = await fetch(window.location.origin+"/api/getData.php?id_expo="+id);
    return data.json();
}

getTranslateinfo().then(expo =>{

    globalThis.spanish["expo"]["info"] = expo.informacion;
    globalThis.spanish["expo"]["name"] = expo.nombre;


    globalThis.english["expo"]["info"] = expo.info_eng;
    globalThis.english["expo"]["name"] = expo.name_eng;

    globalThis.exceptionTranslate(globalThis.getLangArray(), "expo");
})