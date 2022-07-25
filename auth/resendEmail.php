<?php  
include "../includes/db.php";
include "../includes/functions.php";


if(!isset($_POST["email"]) || !isset($_POST["eToken"])){
    header("location: /");
    die();
}
$email = $_POST["email"];
$eToken = $_POST["eToken"];

$query = "SELECT disponible_resend,  verifyToken FROM noverifieduser WHERE email = ? AND emailToken = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "ss", $email, $eToken);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(!$result){
    header("location: /");
    die();
}

$result = mysqli_fetch_assoc($result);

$dateResend = $result["disponible_resend"];

$timeZone = new DateTimeZone("GMT-6");
$GMT_6 = 21600;


$dateAvaible = date_create($dateResend, $timeZone);
$now = new DateTime("now", $timeZone);

//Get TimeStamp
$dateAvaible = date_timestamp_get($dateAvaible);
$now = date_timestamp_get($now);

//Check the time if time is avaible to resend email
if($now > $dateAvaible){
    echo "avaible";
    // Make DateTime to insert in DB
    $dateAvaible = gmdate("Y/m/d H:i:s",(time()-$GMT_6+60));
    $dateAvaible = new DateTime($dateAvaible);
    $dateAvaible = (array) $dateAvaible;
    $dateAvaible = $dateAvaible["date"];


    mysqli_query($db, "UPDATE noverifieduser SET disponible_resend = '$dateAvaible'  WHERE emailToken = '$eToken' ");

    $ip = getHostByName(getHostName());
    $token = $result["verifyToken"];

    $url = "http://${ip}/auth/verifyEmail.php?verifyToken=${token}";
    $message = templateEmail("Verificar email", $nombre, "Haz click en el boton para verificar tu email !",$url,"Verifica tu cuenta");
    mail($email, "Verificar tu cuenta de email en MUO", $message, "Content-Type: text/html; charset=UTF-8\r\n");

}

header("location: /pages/verificationEmail.php?email=".$email."&eToken=".$eToken);
?>