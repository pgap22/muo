<?php

use MUO\ActiveRecord;
use MUO\Passwordcode;
use MUO\User;
use MUO\Usuarios;
use MUO\Util;

include "../includes/app.php";


$error = [];

if(!isset($_GET["token"])){
    header("location: /error/errorPassCode.php");
    die();
}

$passToken = $_GET["token"];

#Verificar si la peticion de resetear contraseña existe
$currentPasswordCode = Passwordcode::where("passToken",$passToken);

if(!$currentPasswordCode || $currentPasswordCode->verified == 0){
    header("location: /error/errorPassCode.php");
    die();
}


if(isset($_GET["renew-password"])){

    #Obtener datos de entrada
    $password = $_GET["renew-password"];

    #Validamos contraseña
    Usuarios::validatePassword($password);

    #Detectamos errores
    $error = Usuarios::getErrors();

    if(!$error){
        #Obtengo el id del usuario por el registro de la request de cambiar contraseña
        $userID = $currentPasswordCode->getData("user_id");

        #Encuentro el usuario que debo modificar su contraseña
        $user = Usuarios::find($userID);

        #Hashear contraseña
        $password = password_hash($password, PASSWORD_DEFAULT);

        #Cambio la contraseña
        $user->setData("password", $password);

        #Actualizo el objeto
        $user->save();


        #Borrar todos los request del usuario porque no se van a ocupar
        ActiveRecord::executeSQL("DELETE FROM passwordcode WHERE user_id = $userID");
     
        session_start();
        $_SESSION["verification"] = true;
        header("location: /pages/renewPassComplete.php");
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

<body data-page="set-new-password">

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
                    Cambiar contraseña
                </h1>
                <p id="text">Listo ahora digita tu nueva contraseña !</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/password.svg" alt="password Icon" class="verification__error">
            </div>
            
            <form class="verification__form" action="setNewPassword.php" method="GET">
                <div class="form__input flex-center">
                    <label for="email-recover" class="form__label" id="label">Nueva contraseña</label>
                    <?php  
                    getError($error, "recover-password");
                    ?>
                    <div class="form__password <?= getColorError($error, "recover-password")?>">
                            <input type="password" name="renew-password" id="password_new" placeholder="Ingresa tu contraseña" required autocomplete="current-password">
                            <img src="../img/icons/eye-off.svg" width="30" alt="" id="password_see">
                    </div>
                </div>
                <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text" id="btn">Enviar</span>
                        <span class="verification__decoration"></span> 
                </button>
                <input type="hidden" value="<?=$passToken?>" name="token">
            </form>
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
    <script src="../js/button.js"></script>
    <script src="../js/password.js"></script>
</body>

</html>