let inputCodes = document.querySelectorAll(".verification__code");


inputCodes.forEach((e, i) => {

    e.addEventListener("keydown", (event) => {
        // console.log(event);
        if (parseInt(event.key) || event.key == 0) {

            if (inputCodes[i + 1]) {

                if (inputCodes[i + 1].value) {
                    inputCodes[i].value = event.key;
                } else {
                    if (inputCodes[i].value) {
                        inputCodes[i + 1].focus();
                    }
                }

            }
                        
            
        }

        
        if (event.key == 'Backspace') {
            if(!inputCodes[i].value){
                if (inputCodes[i - 1]) {
                    if (inputCodes[i - 1].value) {
                        inputCodes[i].value = '';
                        inputCodes[i - 1].focus();
                    }
                }
            }
        }

    })
    e.addEventListener("paste", (event) => {
        let inputsValue = [];
        

        event.preventDefault();
        code = event.clipboardData.getData('text');
        code = code.split("");
        // console.log(code);
        code.forEach((number, k) => {
            if (k > 5) return
            if (parseInt(number) || number == "0") {
                if (inputCodes[k]) {
                    inputCodes[k].value = number;
                }
            }
        })

        inputCodes.forEach((inputNumber,k) => {
            if(inputNumber.value){
                inputsValue[k] = inputNumber.value;
            }
            else{
                if(inputsValue[k]){
                    inputsValue.splice(k,1)
                }
            }
            
            for (let counter = 0; counter < inputsValue.length; counter++) {
                const value = inputsValue[counter];
                
                if(!value) return
                console.log(counter)
                
                if(counter == 4){
                    console.log("Exito");
                   
                    document.querySelector("form").submit();
                }
                
            }

        })
    })


})

let userId = document.querySelector(".user-id").value
let token = document.querySelector(".token-passcode").value
async function getTime(){
    let data =  await fetch(document.location.origin+"/api/checkResend.php?passToken="+token+"&"+"user_id="+userId);
    return data.json();
}

async function updateClientTimer(){
    let time  =  await getTime();

    
    let resendCode = new Date(time.resend_code);
    let now = new Date();
    let diffSeconds = Math.ceil((resendCode-now) / 1000 );
    
    
    if(diffSeconds >= 0){
        document.querySelector(".verification__timer").classList.remove("hidden");
        document.querySelector(".verification__counterdown").innerHTML = diffSeconds;
    }else{
        document.querySelector(".verification__timer").classList.add("hidden");
        // clearInterval(updateTimer);
    }
    
    
    console.log(diffSeconds);

    let updateTimer = setInterval(() => {
        let now = new Date();
        
        let diffSeconds = Math.ceil((resendCode-now) / 1000 );

        if(diffSeconds >= 0){
            document.querySelector(".verification__counterdown").innerHTML = diffSeconds;
        }else{
            document.querySelector(".verification__timer").classList.add("hidden");
            clearInterval(updateTimer);
        }

    }, 1000);

}
updateClientTimer();


let inputs = document.querySelectorAll("input[type=number]");
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