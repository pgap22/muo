<?php  
session_start();
if(!isset($_SESSION["userData"])){
    header("location: /");
}


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

    <link rel="preload" href="../css/verificationEmail/mobile/style.css" as="style">
    <link rel="preload" href="../css/verificationEmail/desktop/style.css " as="style">
    <link rel="stylesheet" href="../css/verificationEmail/mobile/style.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/verificationEmail/desktop/style.css " media="(min-width: 742px)">
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
                    Verifica tu correo electronico
                </h1>
                <div class="verification__email">
                    <p><?=$_SESSION["userData"]["email"]?></p>
                </div>
                <p class="verification__wrong-mail">Si has escrito mal tu correo has <a class="underline"
                        href="/pages/register.php">click aqui</a> </p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/mail.svg" alt="Mail Icon">
            </div>

            <div class="verification__resend">

                <button type="submit" class="verification__button">
                    <span class="verification__button-text">Reenviar</span>
                    <span class="verification__decoration"></span>
                </button>
                <p>¿No recibiste nuestro correo electrónico?</p>
            </div>

        </div>
    </main>
    <script src="../js/general.js"></script>
    <script src="../js/verificationEmail.js"></script>
</body>

</html>