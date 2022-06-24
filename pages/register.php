<?php  
    session_start();
    (isset($_SESSION["userData"]) ? $newUser = $_SESSION["userData"] : "");
    function displayError($errorMessage){   
            ?>
        <p class="errorMessage error"><?= $errorMessage ?></p>
        <?php 
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
    <body>
        <?php  
        if(isset($_SESSION["messageRegister"])){
            unset($_SESSION["messageRegister"]);
             ?>
            <div class="alert">
                <div class="alert__message">
                    <div class="alert__header">
                        <img src="../img/icons/cancel.svg" alt="Exit Alert">
                    </div>
                    <div class="alert__img">
                        <img width="100" src="../img/icons/quality.svg" alt="Checked Logo">
                    </div>

                    <p>Gracias por elegir a MUO, estamos felices que te interes nuestra plataforma!. <br><br> Estas a un ultimo paso para completar el registro, checa la bandeja de entrada de tu correo para verficar tu cuenta y disfrutar de MUO ! </p>
                    <div class="alert__boton">
                        <div class="boton">Cerrar</div>
                    </div>
                </div>
            </div>
            <?php 
        }

        ?>
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
                    <h1>Registrate</h1>
                </div>
                <div class="main__description">
                    <p>
                        Descubre la cultura que nos rodea
                    </p>
                </div>
           </div>
           <form action="/auth/createUser.php" class="form" method="POST">
                <div class="form__input-names">
                    <div class="form__input form__input--two-columns">
                        <label for="new_name">Nombre</label>
                        <?php 
                        if(isset($_SESSION["messageError"]["name-error"])){
                            displayError($_SESSION["messageError"]["name-error"]);
                        }
                    ?>
                        <input autofocus type="text" class="form__name <?php (isset($_SESSION["error"]["name-border"]) ? print($_SESSION["error"]["name-border"]) : "")  ?>" id="new_name" name="new_name" required placeholder="Nombre" value="<?php (isset($newUser["name"]) ? print($newUser["name"]) : ""); ?>" >
                    </div>
                    <div class="form__input form__input--two-columns">
                        <label for="new_last-name">Apellido</label>
                        <?php 
                        if(isset($_SESSION["messageError"]["last-name-error"])){
                            displayError($_SESSION["messageError"]["last-name-error"]);
                        }
                    ?>
                        <input type="text" class="form__last-name  <?php (isset($_SESSION["error"]["last-name-border"]) ? print($_SESSION["error"]["last-name-border"]) : "")  ?>" id="new_last-name" name="new_last-name" required placeholder="Apellido" value="<?php (isset($newUser["last-name"]) ? print($newUser["last-name"]) : ""); ?>">
                    </div>
                </div>
                <div class="form__input form__input--one-column">
                    <label for="new_email">Email</label>
                    <?php 
                        if(isset($_SESSION["messageError"]["email-error"])){
                            displayError($_SESSION["messageError"]["email-error"]);
                        }
                    ?>
                    <input type="emaail" class="form__email <?php (isset($_SESSION["error"]["email-border"]) ? print($_SESSION["error"]["email-border"]) : "")  ?>" id="new_email" name="new_email"  placeholder="Ingresa tu email" required value="<?php (isset($newUser["email"]) ? print($newUser["email"]) : ""); ?>">
                </div>
            
                <div class="form__input form__input--one-column">
                    <div class="form__icon-show">
                        <label for="new_password">Contraseña</label>
                        <img src="../img/icons/eye-off.svg" width="30" alt="">
                    </div>
                    <?php 
                        if(isset($_SESSION["messageError"]["password-error"])){
                            displayError($_SESSION["messageError"]["password-error"]);
                        }
                    ?>
                    <input type="password" class="form__password <?php (isset($_SESSION["error"]["password-border"]) ? print($_SESSION["error"]["password-border"]) : "")  ?>" id="new_password" name="new_password"  placeholder="Ingresa tu contraseña" required value="<?php (isset($newUser["password"]) ? print($newUser["password"]) : ""); ?>">
                </div>
                <div class="form__input form__input--one-column">
                    <label for="confirm_password">Confirmar contraseña</label>
                    <input type="password" class="form__confirm <?php (isset($_SESSION["error"]["password-border"]) ? print($_SESSION["error"]["password-border"]) : "")  ?>" id="confirm_password" name="confirm_password"  placeholder="Confirma tu contraseña" required value="<?php (isset($newUser["confirm-password"]) ? print($newUser["confirm-password"]) : ""); ?>">
                </div>
                <div class="form__buttons">
                    <input type="submit" value="Registrate" class="form__submit"> 
                    <a href="login.php" class="form__account">¿Ya tienes cuenta?</a>
                </div>
           </form>
        </main>


            <img class="background" src="../img/register/bg.jpg" alt="fondo-register">


        <footer class="footer">
            <p class="footer__text">MUO - Todos los derechos reservados</p>
        </footer>
        <script src="../js/register.js"></script>
        <script src="../js/general.js"></script>
    </body> 
</html>
<?php  
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    unset($_SESSION["userData"]);
    unset($_SESSION["messageError"]);
    unset($_SESSION["error"]);
?>