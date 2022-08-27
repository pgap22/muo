<?php
include "../includes/app.php";
use MUO\Comentarios;

protegerHome();

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $commentData["contenido"] = sanitizar($_POST["comment"]);
    $commentData["id_usuario"] = $_SESSION["user_id"];
    $commentData["id_exposicion"] = $_SESSION["id_expo"];


    $comentario = new Comentarios($commentData);
    
    $comentario->validate();

    $error = Comentarios::getErrors();
    
    if(!$error){
        $comentario->save();
    }
    
}

$id =  $_SESSION["id_expo"];
header("location: /home/expo.php?id=$id");

?>