<?php
include "../includes/app.php";

use MUO\Usuarios;

if(!isset($_POST["eToken"])){
    header("location: /");
    die();
}

$eToken = $_POST["eToken"];

#Detectar si existe un usuario que se quiera verificar.
$user = Usuarios::checkValidation($eToken);


if(!$user){
    header("location: /");
    die();
}

#Ver si el tiempo es adecuado para reenviar el email (Evitar el spam)
$isTime = $user->isTimeToResend();


if($isTime){

   #Reenviar el email
   $user->resendEmail();
}

header("location: /pages/verificationEmail.php?eToken=".$eToken);
?>