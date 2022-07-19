<?php  
include "../includes/db.php";
include "../includes/functions.php";
if(isset($_GET["verifyToken"])){

$tokenToVerify = $_GET["verifyToken"];

$query = "SELECT * FROM noverifieduser WHERE verifyToken = ?";
$stmt = mysqli_prepare($db,$query);
mysqli_stmt_bind_param($stmt, "s", $tokenToVerify);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$id,$name, $last_name, $password,$email,$verifyToken,$disponiible_resend);
$ok = mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);

if($ok){
    $query = "DELETE FROM noverifieduser WHERE email = '$email' ";
    $query = mysqli_query($db,$query);
    $query = "INSERT INTO usuarios(email, password, nombre_usuario, apellido_usuario) VALUES('$email', '$password', '$name', '$last_name')";
    $query = mysqli_query($db,$query);
    echo  "email verificado";
}
else{
    echo "error en la verificacion";
}

}
?>