let item =  document.querySelector("body").dataset.item;
let itemOne = item.slice(0,item.length-1);
if(itemOne == "exp"){
    itemOne = "exposicion";
}

document.querySelectorAll(".delete-btn").forEach(deleteBtn =>{
    deleteBtn.addEventListener("click", ()=>{
        let alerta = document.createElement("div");
        
        alerta.classList.add("action-alert");
        
        document.querySelector("body").appendChild(alerta);
    

        if(item == "museos"){
            alerta.innerHTML = alertAction("error", "deleteItem()", "Este/a "+itemOne+" se eliminara con todas sus exposiciones y no se podran recuperar ","Desea borrar este/a "+itemOne+" ?","Borrar");
        }
        else{
            alerta.innerHTML = alertAction("error", "deleteItem()", "Este/a "+itemOne+" se eliminara y no se puede recuperar ","Desea borrar este/a "+itemOne+" ?","Borrar");
        }
        readAlertEvent();
    
    })
})
let itemID;

function getItem(element){
    itemID = element.id;
}


function deleteItem() {
    window.location.replace(window.location.origin + "/admin/items/"+item+"/delete.php?id="+itemID);
}
