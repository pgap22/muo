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
}