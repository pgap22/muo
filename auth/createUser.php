<?php  

include "../includes/db.php";
session_start();

$newUser["name"] = ($_POST["new_name"] );
$newUser["last-name"] = $_POST["new_last-name"];
$newUser["email"] = $_POST["new_email"];
$newUser["password"] = $_POST["new_password"];
$newUser["confirm-password"] = $_POST["confirm_password"];

function sendError($label, $messageError, $newUser ){
    $_SESSION["messageError"]["${label}-error"] =  $messageError;
    $_SESSION["error"]["${label}-border"] = "errorBorder"; 
    $_SESSION["userData"] = $newUser;
    header("location: ../pages/register.php");
}

//Checking If the user modify the html
if($newUser["name"] == ""){
    $_SESSION["messageError"]["name-register"] =  "Tu nombre no puede quedar vacio !";

}
else if($newUser["last-name"] == ""){
    $_SESSION["messageError"]["lastname-register"] =  "Tu apellido no puede quedar vacio !";
} 
else if(strlen($newUser["name"]) > 30){
    sendError("name", "Tu nombre supera el maximo de caracteres (30) !", $newUser);
}
else if(strlen($newUser["last-name"]) > 30){
    sendError("last-name", "Tu apellido supera el maximo de caracteres (30) !", $newUser);
}
else if($newUser["email"] == ""){
    sendError("email", "Tu email no puede estar vacio !", $newUser);
}
else if(!filter_var($newUser["email"], FILTER_VALIDATE_EMAIL)){
    sendError("email", "Tu email no es valido !", $newUser);
}
else if($newUser["password"] == ""){
    sendError("password", "Tu contraseña no puede quedar vacia !", $newUser);
}
else if($newUser["confirm-password"] == ""){
    sendError("confirm-password", "Tu contraseña no puede quedar vacia !", $newUser);
}
else if($newUser["password"] != $newUser["confirm-password"]){
    sendError("password", "Tus contraseñas no coinciden", $newUser);
}
echo '<pre>';
var_dump($newUser);
echo '</pre>';


//Check If that email is in the database

$query = "SELECT * FROM usuarios WHERE email= ?";
$stmt = mysqli_prepare($db,$query);
$email = $newUser["email"];
mysqli_stmt_bind_param($stmt,"s",$email);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $matchedEmail, $password, $matchedName, $matchedLastName);
$results = mysqli_stmt_fetch($stmt);

if($results){
    sendError("email", "El email ya esta en uso !", $newUser);
    die();
}


$query = "INSERT INTO usuarios(email, password, nombre_usuario, apellido_usuario) VALUES(?, ?, ?, ?)";
$stmt = mysqli_prepare($db,$query);

mysqli_stmt_bind_param($stmt,"ssss", $email, $password, $nombre, $apellido);

$nombre = $newUser["name"];
$apellido = $newUser["last-name"];
$email = $newUser["email"];
$password = $newUser["password"];
$stmt = mysqli_stmt_execute($stmt);
header("location: /pages/login.php");

?>