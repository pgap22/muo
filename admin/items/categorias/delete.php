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
    $_SESSION["alert"]["message"] = "No se encontro el item!";
    $_SESSION["alert"]["type"] = "warning";
    $_SESSION["alert"]["alert"] = "simple";
    header("location: /admin/items/categorias");
    die();
}

try {
    #Buscar la categoria en ingles para eliminarla
    $categoriaEn = CategoriaEng::where("id_categoria", $categoria->id);
    $categoriaEn->delete();

    #Eliminar la categoria en español
    $categoria->delete();

    $_SESSION["alert"]["message"] = "La categoria ha sido borrada exitosamente!";
    $_SESSION["alert"]["type"] = "success";
    $_SESSION["alert"]["alert"] = "simple";
    header("location: /admin/items/categorias");

} catch (\Throwable $th) {
    $_SESSION["alert"]["message"] = "Hubo un error, trata de borrar otra cosa para intentar eliminar este item!";
    $_SESSION["alert"]["type"] = "error";
    $_SESSION["alert"]["alert"] = "simple";
    header("location: /admin/items/categorias");
}
?>