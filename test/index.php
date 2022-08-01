<?php

include "../includes/functions.php";
session_start();
$_SESSION["lang"] = "es";
$mail["title-es"] = "XD";
$mail["message-es"] = "XD";
sendMail("gerardo.saz120@gmail.com", $mail);
//djceijsecushijtn

?>