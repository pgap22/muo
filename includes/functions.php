<?php 
function sendError($label, $messageError, $newUser, $type, $color = "red" ){
    if($color == "red"){
        $_SESSION["messageError"]["${label}-error"] =  $messageError;
        $_SESSION["error"]["${label}-border"] = "errorBorder"; 
        $_SESSION["userData"] = $newUser;
    }
    else{
        $_SESSION["messageError"]["${label}-warning"] =  $messageError;
        $_SESSION["error"]["${label}-border"] = "warningBorder"; 
        $_SESSION["userData"] = $newUser;
    }
    header("location: ../pages/${type}.php");
    die();
}

?>