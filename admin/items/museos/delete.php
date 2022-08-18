<?php

use MUO\Museos;
use MUO\MuseosEn;

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
    header("location: /admin/items/museos");
}

$id = $_GET["id"];

#Detectar si el item existe
$museo = Museos::find($id);


if(!$museo){
    $_SESSION["alert"]["message"] = "No se encontro el item!";
    $_SESSION["alert"]["type"] = "warning";
    $_SESSION["alert"]["alert"] = "simple";
    header("location: /admin/items/museos");
    die();
}

try {
    #Buscar la categoria en ingles para eliminarla
    $museoEn = MuseosEn::where("id_museo", $museo->id);
    $museoEn->delete();

    #Borrar directorio
    $rutaMuseo = "../../.." . $museo->imagen;
    if(is_file($rutaMuseo)){
        unlink($rutaMuseo);
    }

    #Eliminar la categoria en español
    $museo->delete();


    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "El museo ha sido borrado exitosamente !";
        $_SESSION["alert"]["type"] = "success";
        $_SESSION["alert"]["alert"] = "simple";
    }else{
        $_SESSION["alert"]["message"] = "The museum has been deleted successfully !";
        $_SESSION["alert"]["type"] = "success";
        $_SESSION["alert"]["alert"] = "simple";
    }

    header("location: /admin/items/museos");
} catch (\Throwable $th) {

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

    header("location: /admin/items/museos");
}

?>