let item =  document.querySelector("body").dataset.item;

document.querySelectorAll(".delete-btn").forEach(deleteBtn =>{
    deleteBtn.addEventListener("click", ()=>{
        let alerta = document.createElement("div");
        
        alerta.classList.add("action-alert");
        
        document.querySelector("body").appendChild(alerta);
    

            if(sessionStorage.getItem("lang") == "es"){
                alerta.innerHTML = alertAction("error", "deleteItem()", "Este item se eliminara y no se puede recuperar ","Desea borrar este item ?","Borrar");
            }
            else{
                alerta.innerHTML = alertAction("error", "deleteItem()", "This item will be eliminated and cannot be recovered","Would you like to delete this item ?","Delete", "Close"); 
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
