<?php

use MUO\Passwordcode;

include "../includes/app.php";

if(!isset($_GET["token"])){
    header("location: /pages/recoverPassword.php");
    die();
}

$error = [];
$passToken = $_GET["token"];

#Obtener el codigo que el usuario digito a traves del metodo GET
$code = Passwordcode::convert_GET_InCode();

#Verificar si la peticion de resetear contraseña existe
$currentPasswordCode = Passwordcode::where("passToken",$passToken );

if(!$currentPasswordCode){
    header("location: /pages/recoverPassword.php");
    die();
}

if(isset($_GET["form-submited"])){

  
    $isVerify = Passwordcode::validate($code, $passToken);
        

    if($isVerify){
        //Checa si esta expirado
        $currentPasswordCode->isExpired();
    }    
    
    $error = Passwordcode::getErrors();

    if(!$error){
        $currentPasswordCode->verify();
        header("location: /pages/setNewPassword.php?token=".$currentPasswordCode->passToken);
    }
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

<body data-page="change-password">

    <main>
        <div class="verification">
            <div class="verification__top">

                <div class="verification__back">
                    <a href="/pages/recoverPassword.php"><img src="../img/icons/arrowLeft.svg" alt="Back"></a>
                </div>

                <picture class="verification__logo">
                    <source srcset="../img/logo/logo.svg" media="(min-width: 742px)">
                    <img src="../img/logo/logo-mobile.svg" alt="logo de MUO">
                </picture>
            </div>
            <div class="verification__text">
                <h1 class="verification__title" id="title">
                    Ingresa el codigo de verificaion
                </h1>
                <p class="verification__wrong-mail" id="text">Verifica en tu correo el codigo de verificacion que te hemos enviado</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/key.svg" alt="key Icon" class="verification__error">
            </div>
            <div class="verification__timer hidden">
                <p class="verification__counterdown">0:00</p>
                <p class="verification__timer-error" id="resend">Proximo reenvio</p>
            </div>

            <div class="verification__main-content">
                <div class="verification__error-message">
                    <?php  
                        getError($error, "resend-code");
                    ?>
                </div>

                <form action="changePassword.php" class="verification__form" method="GET" name="passwordCode" required>
                    <div class="verification__code-reset">
                        <div class="verification__input-code">
                            <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-1">
                        </div> 
                        <div class="verification__input-code">
                            <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-2">
                        </div> 
                        <div class="verification__input-code">
                            <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-3">
                        </div> 
                        <div class="verification__input-code">
                            <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-4" >
                        </div> 
                        <div class="verification__input-code">
                            <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-5">
                        </div> 
                    </div>
            </div>

                <input type="text" hidden value="<?=$passToken?>" name="token" class="token-passcode">
                <input type="text" hidden value="<?=$userId?>" class="user-id">
                <input type="text" hidden name="form-submited" value="true" >

                <a href="/auth/resendPassCode.php?token=<?=$passToken?>" class="verification__resend-code" id="resend-pass-code">Reenviar codigo</a>

                <button type="submit" class="verification__button">
                        <span class="verification__button-text" id="btn">Verificar codigo</span>
                        <span class="verification__decoration"></span> 
                </button>
            </form>

           
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
    <script src="../js/passCode.js"></script>
    <script src="../js/button.js"></script>
</body>

</html>