<?php  
include "../includes/db.php";
include "../includes/functions.php";
session_start();

$email = $_GET["email"];
$eToken = $_GET["eToken"];

$query = "SELECT * FROM noverifieduser WHERE email = ? AND emailToken = ? ";

$stmt = mysqli_prepare($db, $query);

mysqli_stmt_bind_param($stmt, "ss", $email, $eToken);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$result = mysqli_fetch_assoc($result);
if(!$result){
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
                    <p><?=$email?></p>
                </div>
                <p class="verification__wrong-mail">Si has escrito mal tu correo has <a class="underline"
                        href="/pages/register.php">click aqui</a> </p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/mail.svg" alt="Mail Icon">
            </div>


            <div class="verification__resend">
                    
            <div class="verification__timer hidden">
                <p class="verification__counterdown">0:00</p>
                <p class="verification__timer-error">Proximo reenvio</p>
            </div>  
                    <!-- <a href="/auth/resendEmail.php?email=<?=$email?>&eToken=<?=$eToken?>" class="verification__button">
                        <span class="verification__button-text">Reenviar</span>
                        <span class="verification__decoration"></span>
                    </a> -->

            <div class="verification__submit-resend">
                <form action="/auth/resendEmail.php" method="POST" class="verification__form">

                    <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text">Reenviar</span>
                        <span class="verification__decoration"></span> 
                    </button>

                    <input type="text" hidden id="eToken" name="eToken" value="<?=$eToken?>">
                    <input type="text" hidden id="email" name="email" value="<?=$email?>">
                </form>
            </div>
          
                <p>¿No recibiste nuestro correo electrónico?</p>
                <!-- <input type="text" hidden id="eToken" value="<?=$eToken?>">
                <input type="text" hidden id="email" value="<?=$email?>"> -->
            </div>

        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
    <script src="../js/resend.js"></script>
</body>

</html>