<?php 
header("Access-Control-Allow-Origin: *");

include "../includes/db.php";

if(isset($_GET["emailToken"]) & isset($_GET["email"])){
    $eToken = $_GET["emailToken"];
    $email = $_GET["email"];
    $query = "SELECT disponible_resend FROM noverifieduser WHERE email = ? AND emailToken = ?";
    
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $eToken);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($result);

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