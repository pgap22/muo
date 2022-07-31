<?php  
include "../includes/db.php";
include "../includes/functions.php";

if(!isset($_GET["token"])){
    header("location: /pages/recoverPassword.php");
}
$token = $_GET["token"];

$query = "SELECT * FROM passwordcode WHERE passToken = ?";
$result = checkToken($db,$query,$token );
$userData = checkToken($db, "SELECT email FROM usuarios WHERE id = ?", $result["user_id"]);

if(!$result){
    header("location: /pages/recoverPassword.php");
}

$checkResend =  strtotime($result["resend_code"]);
$now = date_timestamp_get((new DateTime("now")))-GMT_6;


if($now>$checkResend){
$query = "UPDATE passwordcode SET resend_code = ?, limit_time = ?, code = ? WHERE passToken = ?";
$stmt = mysqli_prepare($db, $query);

$code = rand(10000, 99999);
$code= intval($code);

$resendCode = date_timestamp_get( (new DateTime("now", TIMEZONE_GMT6)) )+60;
$timeLimit = date_timestamp_get( (new DateTime("now", TIMEZONE_GMT6)) )+900;

$resendCode = gmdate("Y/m/d H:i:s",($resendCode-GMT_6));
$timeLimit = gmdate("Y/m/d H:i:s",($timeLimit-GMT_6));

mysqli_stmt_bind_param($stmt, "ssis", $resendCode, $timeLimit,$code, $token);
mysqli_stmt_execute($stmt);

$message= templateEmailNoButton("Recuperar contraseña", $result["nombre"], "Hola, copia y pega este codigo de verificacion donde se te indique\n\n<b>Recuerda que en 15 minutos el codigo se expirara", $code);
mail($userData["email"], "Recuperar contraseña de MUO", $message, "Content-Type: text/html; charset=UTF-8\r\n");
header("location: /pages/changePassword.php?token=".$token  );    

}
else{
    header("location: /pages/changePassword.php?token=".$token);
}


?>