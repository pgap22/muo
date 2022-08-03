<?php

use MUO\Passwordcode;
use MUO\User;

include "../includes/app.php";

if(!isset($_GET["token"])){
    header("location: /pages/recoverPassword.php");
    die();
}
$passToken = $_GET["token"];

#Verificar si la peticion de resetear contraseña existe
$currentPasswordCode = Passwordcode::getRequestByPassToken($passToken);

#Obtener el user id de la peticion de PasswordCode
$userId = $currentPasswordCode->getUserId();

#Obtener datos del usuario atraves del id
$user = User::getUserById($userId);

#Detectar si se el tiempo es el adecuado para reenviar el codigo
$isTimeResend = $currentPasswordCode->isTimeResend();

// debugear($isTimeResend);

// die();
if(!$user){
    header("location: /pages/recoverPassword.php");
    die();
}


if($isTimeResend){

    $currentPasswordCode->changeTimes();

    $currentPasswordCode->setNewCode();
     
    $currentPasswordCode->sendCode();
  
    header("location: /pages/changePassword.php?token=".$currentPasswordCode->passToken);    
}
else{
    header("location: /pages/changePassword.php?token=".$currentPasswordCode->passToken);
}


?>