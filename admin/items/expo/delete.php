<?php

use MUO\Comentarios;
use MUO\Exposeng;
use MUO\Exposiciones;
use MUO\Favoritos;
use MUO\Imagenesexpo;

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
    header("location: /admin/items/expo");
}

$id = $_GET["id"];

#Detectar si el item existe
$exposicion = Exposiciones::find($id);


if(!$exposicion){
    
    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "No se encontro el item!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }else{
        $_SESSION["alert"]["message"] = "Item was not found!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }
    header("location: /admin/items/expo");
    die();

}

try {

    #Backups por si da un error
    $expoEngBack = Exposeng::where("id_expo", $exposicion->id);
    $expoEngBack->setData("id", '');
    
    #Borrar la exposicion en ingles
    Exposeng::where("id_expo", $exposicion->id)->delete();
    
    #Borrar los comentarios
    Comentarios::executeSQL("DELETE FROM comentarios WHERE id_exposicion = $exposicion->id");
    #Borrar los favoritos
    Favoritos::executeSQL("DELETE FROM favoritosusuarios WHERE id_exposicion = $exposicion->id");

    #Eliminar Imagenes
    $imagenes = Imagenesexpo::where("id_exposicion", $exposicion->id, 0);

    if (!$imagenes) {
        $imagenes = [];
    }

    foreach ($imagenes as $imagen) {
        #Ruta de la imagen
        $rutaImagen = "../../.." . $imagen->rutaImagen;

        #Eliminar Imagen
        if (is_file($rutaImagen)) {
            unlink($rutaImagen);
        }

        #Borrarlo de la base de datos
        $imagen->delete();
    }

    #Borrar la exposicion
    $exposicion->delete();

    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "La exposicion ha sido borrada exitosamente!";
        $_SESSION["alert"]["type"] = "success";
        $_SESSION["alert"]["alert"] = "simple";
    }
    else{
        $_SESSION["alert"]["message"] = "The exhibition has been deleted successfully!";
        $_SESSION["alert"]["type"] = "success";
        $_SESSION["alert"]["alert"] = "simple";
    }
    header("location: /admin/items/expo");

} catch (mysqli_sql_exception $e) { 
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
    $error = true;
    if($expoEngBack){
        $expoEngBack->save();
    }


    header("location: /admin/items/expo");
}
