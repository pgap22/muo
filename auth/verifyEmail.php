<?php  
include "../includes/db.php";

if(isset($_GET["verifyToken"])){

$tokenToVerify = $_GET["verifyToken"];

$query = "SELECT * FROM usuarios WHERE tokenVerify = ?";
$stmt = mysqli_prepare($db,$query);
mysqli_stmt_bind_param($stmt, "s", $tokenToVerify);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id,$email, $password, $nombre, $apellido, $verified, $tokenToVerify);
$ok = mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if($ok){
    $query = "UPDATE usuarios SET verified = 1 WHERE id = $id";
    $query = mysqli_query($db,$query);
    echo  "email verificado";
}
else{
    echo "error en la verificacion";
}

}
?>