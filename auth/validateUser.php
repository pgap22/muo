<?php  
include "../includes/db.php";
include "../includes/functions.php";
echo '<pre>';
var_dump($_POST);
echo '</pre>';

$userLogin = [];
$userLogin["email"] = $_POST["email_login"];
$userLogin["password"] = $_POST["password_login"];

session_start();

$query = "SELECT * FROM usuarios WHERE email = ? and password = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "ss", $email, $password);


$email = $userLogin["email"];
$password = $userLogin["password"];

mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $email, $password, $nombre, $apellido, $verified, $userToken);

$ok = mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if($ok){
    if(!$verified){
        sendError("login", "Debes verificar tu correo para continuar !", $userLogin, "login", "warning");
        exit();
    }
    $token = openssl_random_pseudo_bytes(16);
    $_SESSION["user_token"] = bin2hex($token);
    header("location: /pages/home.php");
}else{
    
    sendError("login", "Tu email o contraseña no son validos !", $userLogin, "login");
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
}


?>