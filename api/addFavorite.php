<?php

use MUO\Favoritos;

include "../includes/app.php";
protegerHome();

if(isset($_GET["id"])){
    $fav["id_exposicion"] = $_GET["id"];
    $fav["id_usuario"] = $_SESSION["user_id"];

    $favorito = new Favoritos($fav);

    $favorito->validate();

    $error = Favoritos::getErrors();
    
    if(!$error){
        $favorito->save();
        $success["msg"] = "Añadido a favoritos !";
        $success["msgEn"] = "Added to favorites !";
        echo json_encode($success);
    }else{
        $fav = new Favoritos($error["fav"]);
        $fav->delete();
        $success["msg"] = "Eliminado de favoritos !";
        $success["msgEn"] = "Remove from favorites!";
        echo json_encode($success);
    }
    
}

?>