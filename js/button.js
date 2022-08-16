let submitButton = document.querySelector(".verification__button");
let form = document.querySelector("form");
form.addEventListener("submit", ()=>{
    submitButton.disabled = true;
    submitButton.classList.add("loading-submit");
})
