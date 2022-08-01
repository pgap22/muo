<?php
include "../includes/app.php";

use MUO\NoVerifiedUser;

if(!isset($_POST["email"]) || !isset($_POST["eToken"])){
    header("location: /");
    die();
}
$email = $_POST["email"];
$eToken = $_POST["eToken"];

$result = NoVerifiedUser::getEmailToken($email, $eToken);

if(!$result){
    header("location: /");
    die();
}

$unVerifiedUser = new NoVerifiedUser($result);

$isTime = $unVerifiedUser->isTimeToResend();
if($isTime){
   $unVerifiedUser->resendEmail();
}
header("location: /pages/verificationEmail.php?email=".$email."&eToken=".$eToken);
?>