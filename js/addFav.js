async function addFav(id, element) {
    let data = await fetch('http://localhost/api/addFavorite.php?id='+id);
    data.json().then(res=>{
        globalThis.spanish["home"]["alert-title"] = res.msg
        globalThis.english["home"]["alert-title"] = res.msgEn

        let title = '';

        if(sessionStorage.getItem("lang")== "es"){
            title  = res.msg
        }else{
            title = res.msgEn;
        }
        
        let img = element.children[0];

        if(window.location.origin+"/img/icons/favorite.svg" == img.src){
            img.src = window.location.origin+"/img/icons/favAdded.svg";
        }
        else{
            img.src = window.location.origin+"/img/icons/favorite.svg";
        }

        let alert = document.createElement("div");

        alert.innerHTML = alertPop('',title);

        globalThis.exceptionTranslate(globalThis.getLangArray(), "home");

        document.querySelector("body").appendChild(alert);
        
        readAlertEvent();
    })
}
