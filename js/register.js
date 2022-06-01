let password_toggle = document.querySelector(".form__icon-show img");
let password = document.querySelector(".form__password");
let confirmPassword = document.querySelector(".form__confirm");
password_toggle.addEventListener("click", ()=>{
    if(password.type == "password" || confirmPassword.type == "password"){
        password.type = "text";
        confirmPassword.type = "text";
    }
    else{
        password.type = "password";
        confirmPassword.type = "password";
    }
})