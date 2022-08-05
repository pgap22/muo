<?php

    use MUO\NoVerifiedUser;

    include "../includes/app.php";
    

    $error = [];
    $newUser = [];
    #Crea un token
    $emailToken = bin2hex(openssl_random_pseudo_bytes(8));

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        #Recoleccion de datos ingresados por el usuario 
        $newUser["name"] = $_POST["new_name"];
        $newUser["last_name"] = $_POST["new_last-name"];
        $newUser["email"] = $_POST["new_email"];
        $newUser["password"] = $_POST["new_password"];
        $newUser["confirm-password"] = $_POST["confirm_password"];
        $newUser["emailToken"] = $emailToken;


        #Crear el objeto de Usuario no verificado 
        $unVerifiedUser = new NoVerifiedUser($newUser);
        
        #Checkar si el email del Usuario no verificado ya esta usuado
        $unVerifiedUser->getDuplicateEmail();

 
        #Detectar si hay errores al validar las informacion del usuario no verificado
        $unVerifiedUser->validateNewUser();

        #Si hay errores guardarlos en un arreglo
        $error = NoVerifiedUser::$errors;

        if(!$error){
            #Si no hay errores guardamos el usuario en una tabla de usuarios no verificados (Verificados por su email)
            $unVerifiedUser->saveUser();

            #Enviamos la verificacion por correo
            $unVerifiedUser->sendVerification();
            header("location: /pages/verificationEmail.php?email=".$unVerifiedUser->email . "&eToken=". $unVerifiedUser->emailToken);
        }
        
       
    }

  
?>
    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="black">
        <meta name="description" content="Registro para crear una cuenta en MUO">
        <title>MUO - REGISTRO</title>
        <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
        <!--Js-->
        <link rel="preload" href="../js/app.js" as="script">

        <!--Font-->
        <link rel="preload" href="../fonts/font.css" as="style">
        <link rel="stylesheet" href="../fonts/font.css">

        <!--Custom Properties-->
        <link rel="preload" href="../css/general/general.css" as="style">
        <link rel="stylesheet" href="../css/general/general.css">

        <!--Register Styles-->
        <link rel="preload" href="../css/register/mobile/style.css" as="style">
        <link rel="preload" href="../css/register/tablet-desktop/style.css" as="style">

        <link rel="stylesheet" href="../css/register/mobile/style.css" media="(max-width: 741px)">
        <link rel="stylesheet" href="../css/register/tablet-desktop/style.css" media="(min-width: 742px)"> 

    </head>
    <body data-page="register">

        <header class="header">
            <div class="header__container">
                <div class="header__back">
                    <a href="/"><img src="../img/icons/arrowLeft.svg" alt="" class="header__back--button"></a>
                </div>
                <a href="/">
                    <picture class="header__logo">
                        <source srcset="../img/logo/logo.svg" media="(min-width:1023px)">
                        <img src="../img/logo/logo-mobile.svg" alt="">
                    </picture>
                </a>
            </div>
        </header>
        <main class="main">
           <div class="main__text-container">
                <div class="main__title">
                    <h1 id="title" >Registrate</h1>
                </div>
                <div class="main__description">
                    <p id="descripcion">
                        Descubre la cultura que nos rodea
                    </p>
                </div>
           </div>
           <form action="register.php" class="form" method="POST">
                <div class="form__input-names">
                    <div class="form__input form__input--two-columns">
                        <label for="new_name" id="nombre">Nombre</label>
                    <!-- Set errors -->
                    <?php  getError($error, "name") ?>
            
                        <input autofocus type="text" class="form__name <?= getColorError($error, "name")?> " id="new_name" name="new_name" required placeholder="Nombre" value="<?=restoreFormData($newUser, "name")?>" >
                    </div>
                    <div class="form__input form__input--two-columns">
                        <label for="new_last-name" id="apellido">Apellido</label>
                        <!-- Set errors -->
                        <?php  getError($error, "last-name") ?>
                       
                        <input type="text" class="form__last-name <?= getColorError($error, "last-name")?>  " id="new_last-name" name="new_last-name" required placeholder="Apellido" value="<?=restoreFormData($newUser, "last_name")?>">
                    </div>
                </div>
                <div class="form__input form__input--one-column">
                    <label for="new_email">Email</label>
                        <!-- Set errors -->
                        <?php  getError($error, "email") ?>
                     
                    <input type="email" class="form__email <?= getColorError($error, "email")?> " id="new_email" name="new_email"  placeholder="Ingresa tu email" required value="<?=restoreFormData($newUser,"email")?>">
                </div>
                
                <div class="form__input form__input--one-column">
                    
                    <div class="form__icon-show ">
                        <label for="new_password" id="contrasena">Contraseña</label>
                        <img src="../img/icons/eye-off.svg" width="30" alt="">
                    </div>
                     <!-- Set errors -->
                     <?php  getError($error, "password") ?>
                
                    <input type="password" class="form__password <?= getColorError($error, "password")?> " id="new_password" name="new_password"  placeholder="Ingresa tu contraseña" required value="<?=restoreFormData($newUser, "password")?>">
                </div>
                <div class="form__input form__input--one-column">
                    <label for="confirm_password" id="contrasena2">Confirmar contraseña</label>
                    <input type="password" class="form__confirm <?= getColorError($error, "password")?> " id="confirm_password" name="confirm_password"  placeholder="Confirma tu contraseña" required value="<?=restoreFormData($newUser, "confirm-password")?>">
                </div>
                <div class="form__buttons">
                    <!-- <input type="submit" value="Registrate" class="form__submit">  -->
                    <button type="submit" class="form__submit">
                        <span class="form__submit-text" id="boton">Registrate</span>
                        <span class="form__decoration"></span>
                    </button>
                    <a href="login.php" class="form__account" id="account">¿Ya tienes cuenta?</a>
                </div>
                </form>
                <input type="text" value="<?=$emailToken?>" name="emailToken" hidden>
        </main>
        <img class="background" src="../img/register/bg.jpg" alt="fondo-register">
        <footer class="footer">
            <p class="footer__text" id="footer">MUO - Todos los derechos reservados</p>
        </footer>
        <script src="../js/register.js"></script>
        <script src="../js/general.js" type="module"></script>
    </body> 
</html>
