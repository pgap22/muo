async function getTranslateinfo(){
    let id = document.querySelector("body").dataset.id;
    let data = await fetch(window.location.origin+"/api/getData.php?id_expo="+id);
    return data.json();
}

getTranslateinfo().then(expo =>{

    globalThis.spanish["expo"]["info"] = expo.informacion.replaceAll("\\", "");
    globalThis.spanish["expo"]["name"] = expo.nombre.replaceAll("\\", "");

    globalThis.ae = expo.informacion;


    globalThis.english["expo"]["info"] = expo.info_eng.replaceAll("\\", "");
    globalThis.english["expo"]["name"] = expo.name_eng.replaceAll("\\", "");

    globalThis.exceptionTranslate(globalThis.getLangArray(), "expo");
})