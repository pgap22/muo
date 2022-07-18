let password_toggle = document.querySelector(".form__icon-show img");
let password = document.querySelector(".form__password");
let confirmPassword = document.querySelector(".form__confirm");
password_toggle.addEventListener("click", ()=>{
    if(password.type == "password" || confirmPassword.type == "password"){
        password.type = "text";
        confirmPassword.type = "text";
        password_toggle.src = "../img/icons/eye.svg";
    }
    else{
        password.type = "password";
        confirmPassword.type = "password";
        password_toggle.src = "../img/icons/eye-off.svg";
    }
})

let inputs = document.querySelectorAll("input");
for (let i = 0; i < inputs.length; i++) {
    const element = inputs[i];
    element.addEventListener("keypress", ()=>{
        let errors = document.querySelectorAll(".error")
        errors.forEach((e)=>{
            e.classList.remove("error")
        })
        let errorBorder = document.querySelectorAll(".errorBorder")
        errorBorder.forEach((e)=>{
            e.classList.remove("errorBorder")
        })
    })
    element.addEventListener("keydown", (e)=>{
        if(e.key == "Backspace"){
            let errors = document.querySelectorAll(".error")
            errors.forEach((e)=>{
                e.classList.remove("error")
            })
            let errorBorder = document.querySelectorAll(".errorBorder")
            errorBorder.forEach((e)=>{
                e.classList.remove("errorBorder")
            })
        }
    })
}


// let exitIcon = document.querySelector(".alert__header > img");
// let exitButton = document.querySelector(".alert__boton>.boton");
// let alertDiv = document.querySelector(".alert");
// if(alertDiv){
//     exitIcon.addEventListener("click", ()=>{
//         let timeout = parseFloat(window.getComputedStyle(alertDiv).transition.split(" ")[1].split("s")[0])*1000
//         alertDiv.style.opacity = 0;
//         setTimeout(()=>{
//             alertDiv.style.display = "none";
//         },timeout-100)
//     })
//     exitButton.addEventListener("click", ()=>{
//         let timeout = parseFloat(window.getComputedStyle(alertDiv).transition.split(" ")[1].split("s")[0])*1000
//         alertDiv.style.opacity = 0;
//         setTimeout(()=>{
//             alertDiv.style.display = "none";
//         },timeout-100)
//     })
// }

let submitButton = document.querySelector(".form__submit");
let form  = document.querySelector(".form")
form.addEventListener("submit", ()=>{
    submitButton.disabled = true;
    submitButton.classList.add("loading-submit");
})