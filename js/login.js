let password_toggle = document.querySelector("#password_see");
let password = document.querySelector("#password_login");
password_toggle.addEventListener("click", ()=>{
    if(password.type == "password"){
        password.type = "text";
    }
    else{
        password.type = "password";
    }
})