let search = document.querySelector("body").dataset.search;
let parentElement = document.querySelector(".search-result");

globalThis.getSearch(search).then(data => {
    data.forEach(expo => {
        //Identificar cual se va a renderizar
          if (sessionStorage.getItem("lang") == "en") {
            nameTranslated = expo.name_eng;
            infoTranslated = expo.info_eng;
        } else {
            nameTranslated = expo.nombre;
            infoTranslated = expo.informacion;
        }

        //Añadir info en ingles y español ademas de acortarla para el home
        globalThis.spanish["search"]["recommend-" + expo.id] = infoShortener(expo.informacion);
        globalThis.spanish["search"]["recommend-title-" + expo.id] = expo.nombre;

        globalThis.english["search"]["recommend-" + expo.id] = infoShortener(expo.info_eng);
        globalThis.english["search"]["recommend-title-" + expo.id] = expo.name_eng;
        
        globalThis.renderRecommendComponent(expo.id, parentElement, expo.imagen, nameTranslated, infoShortener(infoTranslated));
    });
});

function infoShortener(info) {
    if (info.split(" ").length > 15) {
        return info = info.split(" ").slice(0, 15).join(" ") + "...";
    } else {
        return info = info.split(" ").slice(0, info.split(" ").length - 1).join(" ") + "...";
    }
}