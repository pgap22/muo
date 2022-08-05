<?php
include "../includes/app.php";

use MUO\NoVerifiedUser;

if(!isset($_POST["email"]) || !isset($_POST["eToken"])){
    header("location: /");
    die();
}

$email = $_POST["email"];
$eToken = $_POST["eToken"];

#Detectar si existe un usuario que se quiera verificar.
$unVerifiedUser = NoVerifiedUser::detectEmailToken($email, $eToken);


if(!$unVerifiedUser){
    header("location: /");
    die();
}

#Ver si el tiempo es adecuado para reenviar el email (Evitar el spam)
$isTime = $unVerifiedUser->isTimeToResend();

if($isTime){

   #Reenviar el email
   $unVerifiedUser->resendEmail();
}

header("location: /pages/verificationEmail.php?email=".$email."&eToken=".$eToken);
?>