//Timer

//Get the avalible time to resend
let eToken = document.getElementById("eToken").value
let email = document.getElementById("email").value

async function getTimeResend(){
    let time = await fetch(document.location.origin+"/api/checkResend.php?email="+email+"&emailToken="+eToken);
    return time.json();
}

getTimeResend(email, eToken).then( timeResend =>{
    
    let dateTimeUser = new Date(timeResend.disponible_resend);
    let now = new Date();
    

 

    let updateClientTimer = setInterval(()=>{
        now = new Date();
        updateTimer(dateTimeUser, now, updateClientTimer)
      
    }, 1000);

    updateTimer(dateTimeUser, now, updateClientTimer);
   
})

function updateTimer(dateUser, dateNow, timer) {
    document.querySelector(".verification__timer").classList.remove("hidden");
    seconds =  Math.floor((dateUser-dateNow)/1000);
    console.log(seconds)
    if(seconds >= 0){
        // dateNow = new Date();
        document.querySelector(".verification__counterdown").innerHTML = seconds;

        // document.querySelector(".verification__button-text").disabled = true;
    }
    else{
        console.log("xd")
        document.querySelector(".verification__timer").classList.add("hidden");
        if(timer){
            clearInterval(timer)
        }
        // document.querySelector(".verification__button-text").disabled = false;
    }
}
