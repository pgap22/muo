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
