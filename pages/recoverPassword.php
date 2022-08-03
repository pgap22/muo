<?php

use MUO\Passwordcode;
use MUO\User;

include "../includes/app.php";

$errors = [];

$wrongEmail = false;
$emptyEmail = false;
$email = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    #Recolectar el email digitado por el usuario
    $email = $_POST["email-recover"];

    #Validar si el email digitado existe en la BD (Por si esta registrado a la pagina)
    $user = Passwordcode::validateEmail($email);
    
    #Si la validacion da errores se guardan en un arreglo
    $errors = Passwordcode::getErrors();
    
    if(!$errors){
        #Recolectar Datos para instanciar el objeto
        
        $passCode["user_id"] = $user->id; //Este objeto solo necesita el user id para instanciarlo

        #Si no hay errores se instancia un objeto para crear una peticion
        $passCode = new Passwordcode($passCode);
        
        #Esa peticion se guarda en la base de datos
        $passCode->saveRequest();
        
        #Se envia el codigo de para completar la peticion de cambio de contraseña
        $passCode->sendCode();
        
        header("location: /pages/changePassword.php?token=$passCode->passToken");
    }else{
        #Si hay errores en el arreglo se le da valor y si no existe ese determinado error se guardar falso por determinado
        $wrongEmail = $errors["wrongEmail"] ?? false;
        $emptyEmail = $errors["emptyEmail"] ?? false;
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

<body data-page="recover-pass">

    <main>
        <div class="verification">
            <div class="verification__top">

                <div class="verification__back">
                    <a href="/pages/login.php"><img src="../img/icons/arrowLeft.svg" alt="Back"></a>
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
                <p id="text">Ingresa tu correo para cambiar la contraseña !</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/password.svg" alt="password Icon" class="verification__error">
            </div>
            
            <form class="verification__form" action="recoverPassword.php" method="POST">
                <div class="form__input">
                    <label for="email-recover">Email</label>
                    
                    <?= sendMessage("El email no esta registrado con una cuenta en MUO", $wrongEmail, "wrong-email")?>
                    <?= sendMessage("El email esta vacio", $emptyEmail, "empty-email")?>

                    <input type="email" name="email-recover" id="email-recover" required placeholder="Ingresa tu email"  value=<?= getInputValue($email);?>>
                </div>
                <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text" id="btn">Enviar</span>
                        <span class="verification__decoration"></span> 
                </button>
            </form>
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
    <script src="../js/button.js"></script>
</body>

</html>