<?php  
include "../includes/db.php";

if(!isset($_GET["token"])){
    header("location: /error/errorPassCode.php");
    die();
}
$token = $_GET["token"];

$query = "SELECT * FROM passwordCode where passToken = ?";
$stmt = mysqli_prepare($db, $query);

mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$result = mysqli_fetch_assoc($result);

echo '<pre>';
var_dump($result);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" content="Un sitio web de museos">
    <title>MUO - CODIGO VERIFICACION</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">

    <link rel="preload" href="../css/emailTemplate/mobile/style.css" as="style">
    <link rel="preload" href="../css/emailTemplate/desktop/style.css " as="style">
    <link rel="stylesheet" href="../css/emailTemplate/mobile/style.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/emailTemplate/desktop/style.css " media="(min-width: 742px)">
</head>

<body>

    <main>
        <div class="verification">
            <picture class="verification__logo">
                <source srcset="../img/logo/logo.svg" media="(min-width: 742px)">
                <img src="../img/logo/logo-mobile.svg" alt="logo de MUO">
            </picture>
            <div class="verification__text">
                <h1 class="verification__title">
                    Ingresa el codigo de verificaion
                </h1>
                <p class="verification__wrong-mail">Verifica en tu correo el codigo de verificacion que te hemos enviado</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/key.svg" alt="key Icon" class="verification__error">
            </div>
            
            <a href="/" class="verification__button">
                        <span class="verification__button-text">Volver al inicio</span>
                        <span class="verification__decoration"></span>
            </a>
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
</body>

</html>