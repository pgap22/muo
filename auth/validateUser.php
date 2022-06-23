<?php  
include "../includes/db.php";

echo '<pre>';
var_dump($_POST);
echo '</pre>';

session_start();
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

$query = "SELECT * FROM usuarios WHERE email = ? and password = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "ss", $email, $password);
mysqli_stmt_execute($stmt);
$ok = mysqli_stmt_bind_result($stmt, $id, $email, $password, $nombre, $apellido);

if($ok){
    $token = openssl_random_pseudo_bytes(16);
    $_SESSION["user_token"] = bin2hex($token);
    header("location: /pages/home.php");
}

?>