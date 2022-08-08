<?php

use MUO\Passwordcode;
use MUO\Usuarios;
use MUO\Util;

include "../includes/app.php";

if(!isset($_GET["token"])){
    header("location: /pages/recoverPassword.php");
    die();
}
$passToken = $_GET["token"];

#Verificar si la peticion de resetear contraseña existe
$currentPasswordCode = Passwordcode::where("passToken",$passToken );



#Obtener datos del usuario atraves del id
$userId = $currentPasswordCode->getData("user_id");
$user = Usuarios::find($userId);

if(!$user){
    header("location: /pages/recoverPassword.php");
    die();
}


#Detectar si se el tiempo es el adecuado para reenviar el codigo
$isTimeResend = $currentPasswordCode->isResend();


if($isTimeResend){

    #Cambia el tiempo para volver a enviar el codigo y para su expiracion
    $newResend = Util::addTimeFromNow(60)->format("Y/m/d H:i:s");
    $newCode = rand(10000, 99999);
    $newLimit = Util::addTimeFromNow(900)->format("Y/m/d H:i:s");

    #Actualizamos el objeto
    $currentPasswordCode->setData("resend_code", $newResend);
    $currentPasswordCode->setData("limit_time", $newLimit);
    $currentPasswordCode->setData("code", $newCode);

    #Lo Actualizamos en la base de datos
    $currentPasswordCode->save();

    #Se envia ese nuevo codigo
    $currentPasswordCode->sendCode();
  
    header("location: /pages/changePassword.php?token=".$currentPasswordCode->passToken);    
}
else{
    header("location: /pages/changePassword.php?token=".$currentPasswordCode->passToken);
}


?>