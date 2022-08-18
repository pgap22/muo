import { english, spanish } from "./adminTranslate.js";
let page = document.querySelector("body").dataset.page;
let language = sessionStorage.getItem("lang");

if(document.querySelector(".lang")){

let lang = document.querySelector(".lang");
let options = document.querySelector(".lang__options");
let secondLang = document.querySelector(".lang__lang");
let selectedLang = document.querySelector(".lang__selected-text");




if(language == "es"){
    secondLang.children[0].src = '/img/icons/uk.svg';
    
    selectedLang.id = "es";
    secondLang.children[0].id = "en";

    translatePage(spanish, page);

    document.querySelector("[data-primaryLang=es]").innerHTML = "Español";
    document.querySelector("[data-secondLang=en]").innerHTML = "Ingles";


    sessionStorage.setItem("lang", "es");
}
else{
    secondLang.children[0].src = '/img/icons/spain.svg';

    selectedLang.id = "en";
    secondLang.children[0].id = "es";

    translatePage(english, page);
    
    document.querySelector("[data-primaryLang=es]").innerHTML = "English";
    document.querySelector("[data-secondLang=en]").innerHTML = "Spanish";

    sessionStorage.setItem("lang", "en");
}




document.querySelector(".lang__lang").addEventListener("click", ()=>{
    let oldId = selectedLang.id;
    let newIdLang = secondLang.children[0].id;
    let oldLang = selectedLang.innerHTML;


    selectedLang.innerHTML = secondLang.children[1].innerHTML;
    secondLang.children[1].innerHTML = oldLang;


    selectedLang.id = newIdLang;
    secondLang.children[0].id = oldId;

    
    if(selectedLang.id == "es"){
        secondLang.children[0].src = '/img/icons/uk.svg';
        
        sessionStorage.setItem("lang", "es");
        
        document.querySelector("[data-primaryLang=es]").innerHTML = "Español";
        document.querySelector("[data-secondLang=en]").innerHTML = "Ingles";
        

        translatePage(spanish, page, selectedLang.id);
    }
    else{
        secondLang.children[0].src = '/img/icons/spain.svg';
        
        
        document.querySelector("[data-primaryLang=es]").innerHTML = "English";
        document.querySelector("[data-secondLang=en]").innerHTML = "Spanish";
        
        sessionStorage.setItem("lang", "en");
        
        translatePage(english, page, selectedLang.id);
    }

    
})

lang.addEventListener("click", ()=>{
    options.classList.toggle("lang--hide");
})

}
else{
    if(language == "es"){
        translatePage(spanish, page);
        sessionStorage.setItem("lang", "es");   
    }
    else{
        translatePage(english, page);
        sessionStorage.setItem("lang", "en");   
    }
        
}





function exceptionTranslate(lang_array, pageTranslate) {
    let exceptWords = Object.keys(lang_array[pageTranslate]);
    exceptWords.forEach((e)=>{
        if (document.getElementById(e)) {
            document.getElementById(e).innerHTML = lang_array[pageTranslate][e];
        }
    })
}


async function translatePage(langArray, page, langID) {
    let words = Object.keys(langArray[page]);
    words.forEach(element => {
        if (document.getElementById(element)) {
            document.getElementById(element).innerHTML = langArray[page][element];
        }
    });

    exceptionTranslate(langArray, 'general');
    // console.log(document.location.origin+"/api/changeLanguage.php?lang=" + sessionStorage.getItem("lang"));
    await fetch(document.location.origin+"/api/changeLanguage.php?lang=" + langID);

}