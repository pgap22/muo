<?php  

include "../includes/db.php";
include "../includes/functions.php";
session_start();

$newUser["name"] = ($_POST["new_name"] );
$newUser["last-name"] = $_POST["new_last-name"];
$newUser["email"] = $_POST["new_email"];
$newUser["password"] = $_POST["new_password"];
$newUser["confirm-password"] = $_POST["confirm_password"];



//Checking If the user modify the html
if($newUser["name"] == ""){
    sendError("name", "Tu nombre no puede quedar vacio !", $newUser, "register");
}
else if($newUser["last-name"] == ""){
    sendError("last-name", "Tu apellido no puede quedar vacio !", $newUser, "register");
} 
else if(strlen($newUser["name"]) > 30){
    sendError("name", "Tu nombre supera el maximo de caracteres (30) !", $newUser, "register");
}
else if(strlen($newUser["last-name"]) > 30){
    sendError("last-name", "Tu apellido supera el maximo de caracteres (30) !", $newUser, "register");
}
else if($newUser["email"] == ""){
    sendError("email", "Tu email no puede estar vacio !", $newUser, "register");
}
else if(!filter_var($newUser["email"], FILTER_VALIDATE_EMAIL)){
    sendError("email", "Tu email no es valido !", $newUser, "register");
}
else if($newUser["password"] == ""){
    sendError("password", "Tu contraseña no puede quedar vacia !", $newUser, "register");
}
else if($newUser["confirm-password"] == ""){
    sendError("password", "Tu contraseña no puede quedar vacia !", $newUser, "register");
}
else if($newUser["password"] != $newUser["confirm-password"]){
    sendError("password", "Tus contraseñas no coinciden", $newUser, "register");
}
echo '<pre>';
var_dump($newUser);
echo '</pre>';

// //Check If that email is in the database

$query = "SELECT * FROM usuarios WHERE email= ?";
$stmt = mysqli_prepare($db,$query);
$email = $newUser["email"];
mysqli_stmt_bind_param($stmt,"s",$email);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $matchedEmail, $password, $matchedName, $matchedLastName, $matchedVerified);
$results = mysqli_stmt_fetch($stmt);

if($results){
    sendError("email", "El email ya esta en uso !", $newUser, "register");
    die();
}


$query = "INSERT INTO usuarios(email, password, nombre_usuario, apellido_usuario, verified) VALUES(?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($db,$query);

mysqli_stmt_bind_param($stmt,"ssssi", $email, $password, $nombre, $apellido, $verified);

$nombre = $newUser["name"];
$apellido = $newUser["last-name"];
$email = $newUser["email"];
$password = $newUser["password"];
$verified = 0;
$stmt = mysqli_stmt_execute($stmt);
session_unset();
$_SESSION["messageRegister"] = "Gracias por elegir a MUO, estamos felices que te interes nuestra plataforma!. <br><br> Estas a un ultimo paso para completar el registro ";
header("location: /pages/register.php");

// ?>