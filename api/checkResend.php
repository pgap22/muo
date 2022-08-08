<?php 
header("Access-Control-Allow-Origin: *");
 
use MUO\Usuarios;

include "../includes/app.php";

if(isset($_GET["emailToken"])){

    $eToken = $_GET["emailToken"];

    $result = Usuarios::checkValidation($eToken);

    echo json_encode($result);
}

if(isset($_GET["passToken"])){

    $pToken = $_GET["passToken"];


    $query = "SELECT limit_time, resend_code FROM passwordcode WHERE passToken= ?";
    
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $pToken);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($result);

    echo json_encode($result);
}

?>