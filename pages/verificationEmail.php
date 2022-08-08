<?php

    use MUO\NoVerifiedUser;
use MUO\Usuarios;

    include "../includes/app.php";

    $eToken = $_GET["eToken"];

    #Detectar si existe un usuario que se quiera verificar.
    $user = Usuarios::checkValidation($eToken);

    if (!$user) {
        header("location: /error/errorVerification.php");
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

    <link rel="preload" href="../css/emailTemplate/mobile/style.css" as="style">
    <link rel="preload" href="../css/emailTemplate/desktop/style.css " as="style">
    <link rel="stylesheet" href="../css/emailTemplate/mobile/style.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/emailTemplate/desktop/style.css " media="(min-width: 742px)">
</head>

<body data-page="verification-email">

    <main>
        <div class="verification">
            <div class="verification__top">

                <div class="verification__back">
                    <a href="/pages/register.php"><img src="../img/icons/arrowLeft.svg" alt="Back"></a>
                </div>

                <picture class="verification__logo">
                    <source srcset="../img/logo/logo.svg" media="(min-width: 742px)">
                    <img src="../img/logo/logo-mobile.svg" alt="logo de MUO">
                </picture>
            </div>
            <div class="verification__text">
                <h1 class="verification__title" id="title">
                    Verifica tu correo electronico
                </h1>
                <div class="verification__email">
                    <p><?= $user->email ?></p>
                    </div>
                <p class="verification__wrong-mail"> <span id="wrong-email">Si has escrito mal tu correo has</span> <a class="underline" href="/pages/register.php" id="link">click aqui</a> </p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/mail.svg" alt="Mail Icon">
            </div>


            <div class="verification__resend">

                <div class="verification__timer hidden">
                    <p class="verification__counterdown">0:00</p>
                    <p class="verification__timer-error" id="next-send">Proximo reenvio</p>
                </div>
                <!-- <a href="/auth/resendEmail.php?email=<?= $user->email ?>&eToken=<?= $eToken ?>" class="verification__button">
                        <span class="verification__button-text">Reenviar</span>
                        <span class="verification__decoration"></span>
                    </a> -->

                <div class="verification__submit-resend">
                    <form action="/auth/resendEmail.php" method="POST" class="verification__form">

                        <button type="submit" class="verification__button verification__button--submit">
                            <span class="verification__button-text" id="submit-button">Reenviar</span>
                            <span class="verification__decoration"></span>
                        </button>

                        <input type="text" hidden id="eToken" name="eToken" value="<?= $eToken ?>">
                        <input type="text" hidden id="email" name="email" value="<?= $user->email ?>">
                    </form>
                </div>

                <p id="no-recive">¿No recibiste nuestro correo electrónico?</p>
                <!-- <input type="text" hidden id="eToken" value="<?= $eToken ?>">
                <input type="text" hidden id="email" value="<?= $user->email ?>"> -->
            </div>

        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
    <script src="../js/resend.js" type="text/javascript"></script>
    <script src="../js/button.js"></script>
</body>

</html>