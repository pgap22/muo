

    
    function alertSimple(type, message) {
        return `
        <div class="alerta ${type}-alert">
            <div class="alerta__left">
            <img src="/img/alerta/${type}.svg" alt="" class="alerta__icono">
            <p class="alerta__msg">${message}</p>
            </div>
            <img src="/img/alerta/close.svg" alt="" class="alerta__close">
        </div>
        `
    }

    function alertPop(message, title) {
        return `
    <div class="alert-pop-up-container">
        <div class="alert-pop__background"></div>
        
        <div class="alert-pop">
            <img src="/img/alerta/info.svg" alt="Alerta Info" class="alert-pop__icon">
            <h2 class="alert-pop-title">${title}</h2>
            <p class="alert-pop__text">${message}</p>
            <div class="alert-pop__btn close-btn">
                <p class="alert-pop__close">Close</p>
            </div>
        </div>
    </div>
        `
    }

    function alertAction(type, functionName, message, title, btn, btnClose) {
        btn = btn ?? 'Si';
        btnClose = btnClose ?? 'Cerrar'
        type = type ?? 'success';
        
        return `
        <div class="alert-pop-up-container">
            <div class="alert-pop__background"></div>
            
            <div class="alert-pop ${type}-alert">
                <img src="/img/alerta/info.svg" alt="Alerta Info" class="alert-pop__icon">
                <h2 class="alert-pop-title">${title}</h2>
                <p class="alert-pop__text">${message}</p>
                <div class="alert-pop__btns-container">
                    <div class="alert-pop__btn alert-pop__btn--action ${type}-alert action-close" onclick="${functionName}">
                        <p class="alert-pop__close">${btn}</p>
                    </div>
                    <div class="alert-pop__btn no-action action-close">
                        <p class="alert-pop__close">${btnClose}</p>
                    </div>
                </div>
            </div>
        </div>
        `
    }


document.querySelectorAll(".simple-alert").forEach(alerta =>{
    alerta.innerHTML = alertSimple(alerta.dataset.type, alerta.dataset.message);
})
document.querySelectorAll(".pop-up-alert").forEach(alerta =>{
    alerta.innerHTML = alertPop(alerta.dataset.message, alerta.dataset.title);
})
document.querySelectorAll(".action-alert").forEach(alerta =>{
    alerta.innerHTML = alertAction(alerta.dataset.type, alerta.dataset.function ,alerta.dataset.message, alerta.dataset.title, alerta.dataset.btn, alerta.dataset.btnClose);
})


function readAlertEvent() {
  
document.querySelectorAll(".alerta__close").forEach(quit =>{
    quit.addEventListener("click", ()=>{
        quit.parentElement.remove();
    })
})
document.querySelectorAll(".close-btn").forEach(quit =>{
    quit.addEventListener("click", ()=>{
        quit.parentElement.parentElement.remove();
    })
})
document.querySelectorAll(".action-close").forEach(quit =>{
    quit.addEventListener("click", ()=>{
        quit.parentElement.parentElement.parentElement.parentElement.remove()
    })
})

}

window.addEventListener("load", ()=>{
  readAlertEvent();
})