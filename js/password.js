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

password.addEventListener("keydown", ()=>{
    let errors = document.querySelectorAll(".error")
    errors.forEach((e)=>{
        e.classList.remove("error")
    })
    let errorBorder = document.querySelectorAll(".errorBorder")
    errorBorder.forEach((e)=>{
        e.classList.remove("errorBorder")
    })
})
password.addEventListener("keypress", (e)=>{
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