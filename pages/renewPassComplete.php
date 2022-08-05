<?php  
session_start();
if(!isset($_SESSION["verification"])){
    header("location: ../error/errorPassCode.php");
}
unset($_SESSION["verification"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" content="Un sitio web de museos">
    <title>MUO - VERIFICAR EMAIL</title>
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

<body data-page="renew-completed">

    <main>
        <div class="verification">
            <picture class="verification__logo">
                <source srcset="../img/logo/logo.svg" media="(min-width: 742px)">
                <img src="../img/logo/logo-mobile.svg" alt="logo de MUO">
            </picture>
            <div class="verification__text">
                <h1 class="verification__title" id="title">
                    Verificacion completada
                </h1>
                <p id="text">Tu contraseña ha sido restablecido correctamente !</p>
                <p class="verification__close-window" id="close">Puedes cerrar esta ventana o inciar sesion</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/quality.svg" alt="Checked Icon" class="verification__icon">
            </div>
            
            <a href="/pages/login.php" class="verification__button">
                        <span class="verification__button-text" id="button">Iniciar sesion</span>
                        <span class="verification__decoration"></span>
            </a>
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
</body>

</html>