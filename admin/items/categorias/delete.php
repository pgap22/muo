<?php

use MUO\CategoriaEng;
use MUO\Categorias;

include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if(isset($userID)){
    protegerAdmin($userID);
}
else{
    header("location: /");
}


#Detectar si no existe id en la url
if(!isset($_GET["id"])){
    header("location: /admin/items/categorias");
}

$id = $_GET["id"];

#Detectar si el item existe
$categoria = Categorias::find($id);

if(!$categoria){
    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "No se encontro el item!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }else{
        $_SESSION["alert"]["message"] = "Item was not found!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }
    header("location: /admin/items/categorias");
    die();
}

try {
    #Buscar la categoria en ingles para eliminarla
    $categoriaEn = CategoriaEng::where("id_categoria", $categoria->id);
    if($categoriaEn){
        $backupCategoriaEn = CategoriaEng::where("id_categoria", $categoria->id);
        $categoriaEn->delete();
    }

    #Eliminar la categoria en español
    $categoria->delete();

} catch (mysqli_sql_exception) {
    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "Hubo un error, trata de borrar otra cosa para intentar eliminar este item!";
        $_SESSION["alert"]["type"] = "error";
        $_SESSION["alert"]["alert"] = "simple";
    }
    else{
        $_SESSION["alert"]["message"] = "There was a mistake, try to erase something else to try to eliminate this item!";
        $_SESSION["alert"]["type"] = "error";
        $_SESSION["alert"]["alert"] = "simple";
    }
    if($backupCategoriaEn){
        $backupCategoriaEn->setData("id", '');
        $backupCategoriaEn->save();
    }

    header("location: /admin/items/categorias");
    $error = true;
}

if(!$error){
    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "La categoria ha sido borrada exitosamente!";
        $_SESSION["alert"]["type"] = "success";
        $_SESSION["alert"]["alert"] = "simple";
    }
    else{
        $_SESSION["alert"]["message"] = "The category has been deleted successfully!";
        $_SESSION["alert"]["type"] = "success";
        $_SESSION["alert"]["alert"] = "simple";
    }
    header("location: /admin/items/categorias");
}
?>