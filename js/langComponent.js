function startLang(spanish, english) {
    let page = document.querySelector("body").dataset.page;
    let language = sessionStorage.getItem("lang");

    if (document.querySelector(".lang")) {

        let lang = document.querySelector(".lang");
        let options = document.querySelector(".lang__options");
        let secondLang = document.querySelector(".lang__lang");
        let selectedLang = document.querySelector(".lang__selected-text");




        if (language == "es") {
            secondLang.children[0].src = '/img/icons/uk.svg';

            selectedLang.id = "es";
            secondLang.children[0].id = "en";

            translateLang(spanish, page);

            document.querySelector("[data-primaryLang=es]").innerHTML = "Español";
            document.querySelector("[data-secondLang=en]").innerHTML = "Ingles";


            sessionStorage.setItem("lang", "es");
        } else {
            secondLang.children[0].src = '/img/icons/spain.svg';

            selectedLang.id = "en";
            secondLang.children[0].id = "es";

            translateLang(english, page);

            document.querySelector("[data-primaryLang=es]").innerHTML = "English";
            document.querySelector("[data-secondLang=en]").innerHTML = "Spanish";

            sessionStorage.setItem("lang", "en");
        }




        document.querySelector(".lang__lang").addEventListener("click", () => {
            let oldId = selectedLang.id;
            let newIdLang = secondLang.children[0].id;
            let oldLang = selectedLang.innerHTML;


            selectedLang.innerHTML = secondLang.children[1].innerHTML;
            secondLang.children[1].innerHTML = oldLang;


            selectedLang.id = newIdLang;
            secondLang.children[0].id = oldId;


            if (selectedLang.id == "es") {
                secondLang.children[0].src = '/img/icons/uk.svg';

                sessionStorage.setItem("lang", "es");

                document.querySelector("[data-primaryLang=es]").innerHTML = "Español";
                document.querySelector("[data-secondLang=en]").innerHTML = "Ingles";


                translateLang(spanish, page, selectedLang.id);
            } else {
                secondLang.children[0].src = '/img/icons/spain.svg';


                document.querySelector("[data-primaryLang=es]").innerHTML = "English";
                document.querySelector("[data-secondLang=en]").innerHTML = "Spanish";

                sessionStorage.setItem("lang", "en");

                translateLang(english, page, selectedLang.id);
            }


        })

        lang.addEventListener("click", () => {
            options.classList.toggle("lang--hide");
        })

    } else {
        console.log("Start Auto Traduction...")
        if (language == "es") {
            translateLang(spanish, page);
            sessionStorage.setItem("lang", "es");
        } else {
            translateLang(english, page);
            sessionStorage.setItem("lang", "en");
        }

    }
}


function placeHolderTranslate(lang_array, pageTranslate, placeholder) {
    if (document.querySelector("body").dataset.page == pageTranslate) {
        let inputPlaceholder = Object.keys(lang_array[placeholder]);
        inputPlaceholder.forEach(e => {
            document.getElementById(e).placeholder = lang_array[placeholder][e];
        })
    }
}

function exceptionTranslate(lang_array, pageTranslate) {
    let exceptWords = Object.keys(lang_array[pageTranslate]);
    exceptWords.forEach((e) => {
        if (document.getElementById(e)) {
            document.getElementById(e).innerHTML = lang_array[pageTranslate][e];
        }
    })
}

async function museumTranslate() {
    let museoId = document.querySelector("body").dataset.id;
    let dataMuseum = await fetch('http://localhost/api/getData.php?museoid=' + museoId);

    return dataMuseum.json()
}



async function translateLang(langArray, page, langID) {
    if(langArray[page]){
        let words = Object.keys(langArray[page]);
        words.forEach(element => {
            if (document.getElementById(element)) {
                document.getElementById(element).innerHTML = langArray[page][element];
            }
        });
    
    }

    if(page == "museo-info"){
        museumTranslate().then(e => {
            console.log("Getting Data Museum...");
            globalThis.spanish["museo-info"] = [];
            globalThis.spanish["museo-info"]["info"] = e.descripcion;

            globalThis.english["museo-info"] = [];
            globalThis.english["museo-info"]["info"] = e.info_en;

            if (langArray[page]) {
                let words = Object.keys(langArray[page]);
                words.forEach(element => {

                    if (document.getElementById(element)) {
                        document.getElementById(element).innerHTML = langArray[page][element];
                    }


                });
            }
        });
    }

    exceptionTranslate(langArray, "menu");

    // console.log(document.location.origin+"/api/changeLanguage.php?lang=" + sessionStorage.getItem("lang"));
    await fetch(document.location.origin + "/api/changeLanguage.php?lang=" + langID);

}

function langComponent() {
    return `
    <div class="lang">
        <div class="lang__selected">
            <div class="lang__data-selected">
                <img src="/img/icons/language.svg" alt="" class="lang__icon">
                <p class="lang__selected-text" id="es" data-primaryLang="es">Español</p>
            </div>
            <img src="/img/icons/expand_more.svg" alt="" class="lang__expand">
        </div>
        <div class="lang__options lang--hide">
            <div class="lang__lang">
                <img src="/img/icons/uk.svg" class="lang__flag" id="en">
                <p class="lang__lang-text" data-secondLang="en">Ingles</p>
            </div>
        </div>
    </div>
    `
}

function getLangArray() {
    let language = sessionStorage.getItem("lang");
    if (language == "es") {
        return globalThis.spanish;
    }
    
    return globalThis.english;
   
}

export {
    langComponent,
    startLang,
    placeHolderTranslate,
    exceptionTranslate,
    translateLang,
    getLangArray
};