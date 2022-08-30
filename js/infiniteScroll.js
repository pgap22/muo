let page = 1;
let limit = 3;
let parentElement = document.querySelector(".main__feed");
let parentRecommend = document.querySelector(".expo-recommend");
let avaibleScroll = true;
//Recommend Expos
async function getRecommendExpo(){
    let data = await fetch(window.location.origin+'/api/getData.php?recommend-expo');
    return data.json();
}

if(parentRecommend){
    getRecommendExpo().then(expos =>{
        expos.forEach(item => {
    
            //Identificar cual se va a renderizar
            if (sessionStorage.getItem("lang") == "en") {
                nameTranslated = item.name_eng;
                infoTranslated = item.info_eng;
            } else {
                nameTranslated = item.nombre;
                infoTranslated = item.informacion;
            }
    
    
    
            //Añadir info en ingles y español ademas de acortarla para el home
            globalThis.spanish["home"]["recommend-" + item.id] = infoShortener(item.informacion);
            globalThis.spanish["home"]["recommend-title-" + item.id] = item.nombre;
    
            globalThis.english["home"]["recommend-" + item.id] = infoShortener(item.info_eng);
            globalThis.english["home"]["recommend-title-" + item.id] = item.name_eng;
            
            globalThis.renderRecommendComponent(item.id, parentRecommend, item.imagen, nameTranslated, infoShortener(infoTranslated));
        })
    })
}

globalThis.getData('expo', page, limit).then(expos => {
    page++
    expos.forEach(item => {
        //Identificar cual se va a renderizar
        if (sessionStorage.getItem("lang") == "en") {
            nameTranslated = item.name_eng;
            infoTranslated = item.info_eng;
        } else {
            nameTranslated = item.nombre;
            infoTranslated = item.informacion;
        }



        //Añadir info en ingles y español ademas de acortarla para el home
        globalThis.spanish["home"]["info-" + item.id] = infoShortener(item.informacion);
        globalThis.spanish["home"]["name-" + item.id] = item.nombre;

        globalThis.english["home"]["info-" + item.id] = infoShortener(item.info_eng);
        globalThis.english["home"]["name-" + item.id] = item.name_eng;

        globalThis.renderExpoComponent(item.id, parentElement, item.imagen, nameTranslated, infoShortener(infoTranslated),item.isFav);
    });
})



window.addEventListener("scroll", (e) => {
    if ( ((window.innerHeight + window.scrollY) >= document.querySelector("html").offsetHeight) & avaibleScroll ) {
        avaibleScroll = false
        globalThis.getData('expo', page, limit).then(expos => {
            page++
            expos.forEach(item => {

                if (sessionStorage.getItem("lang") == "en") {
                    nameTranslated = item.name_eng;
                    infoTranslated = item.info_eng;
                } else {
                    nameTranslated = item.nombre;
                    infoTranslated = item.informacion;
                }


                //Añadir info en ingles y español ademas de acortarla para el home
                globalThis.spanish["home"]["info-" + item.id] = infoShortener(item.informacion);
                globalThis.spanish["home"]["name-" + item.id] = item.nombre;

                globalThis.english["home"]["info-" + item.id] = infoShortener(item.info_eng);
                globalThis.english["home"]["name-" + item.id] = item.name_eng;

                globalThis.renderExpoComponent(item.id, parentElement, item.imagen, nameTranslated, infoShortener(infoTranslated),item.isFav);
                avaibleScroll = true;
            });
        })

    }
})

function infoShortener(info) {
    if (info.split(" ").length > 15) {
        return info = info.split(" ").slice(0, 15).join(" ") + "...";
    } else {
        return info = info.split(" ").slice(0, info.split(" ").length - 1).join(" ") + "...";
    }
}