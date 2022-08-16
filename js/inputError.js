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

let textarea = document.querySelectorAll("textarea");
for (let i = 0; i < textarea.length; i++) {
    const element = textarea[i];
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
