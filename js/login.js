let password_toggle = document.querySelector("#password_see");
let password = document.querySelector("#password_login");
password_toggle.addEventListener("click", ()=>{
    if(password.type == "password"){
        password.type = "text";

        password_toggle.src = "../img/icons/eye.svg"
    }
    else{
        password.type = "password";
        password_toggle.src = "../img/icons/eye-off.svg"
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

let submitButton = document.querySelector(".form__submit");
let form  = document.querySelector(".form")
form.addEventListener("submit", ()=>{
    submitButton.disabled = true;
    submitButton.classList.add("loading-submit");
})