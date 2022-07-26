<?php
include "../includes/db.php";
include "../includes/functions.php";
$error = [];
$error["code"] = [];
$userLogin = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $userLogin = [];
    $userLogin["email"] = $_POST["email_login"];
    $userLogin["password"] = $_POST["password_login"];

    session_start();

    $query = "SELECT password FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);


    $email = $userLogin["email"];
    mysqli_stmt_execute($stmt);


    $ok = mysqli_stmt_get_result($stmt);
    $ok = mysqli_fetch_assoc($ok);
    
    $ok = password_verify($userLogin["password"], $ok["password"]);

    if ($ok) {
        $token = openssl_random_pseudo_bytes(16);
        $_SESSION["user_token"] = bin2hex($token);
        header("location: /pages/home.php");
    } else {
        $error["login"] = 'Tu email o contraseña no son validos !';
        $error["code"] = 10;
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
    <meta name="description" content="Iniciar sesion en MUO">
    <title>MUO - INCIO DE SESION</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">


    <!--LOGIN STYLE-->
    <link rel="preload" href="../css/login/mobile/style.css" as="style">
    <link rel="preload" href="../css/login/tablet-desktop/style.css" as="style">
    <link rel="stylesheet" href="../css/login/mobile/style.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/login/tablet-desktop/style.css" media="(min-width: 742px)">
</head>

<body data-page="login">
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
        <div class="main__container">
            <section class="main__text">
                <h1 class="main__title" id="title">Iniciar Sesion</h1>

                <p class="main__description" id="descripcion">Continua explorando nuestros origenes para dominar la corriente de nuestras
                    fronteras</p>
            </section>

            <div class="main__form">
                <form action="login.php" class="form" method="POST">
                    <div class="form__inputs">
                        <div class="form__field">
                          
                            <label for="email_login">Email</label>
                            <?php
                                getError($error, "login");
                            ?>
                            <input autofocus type="email" name="email_login" class=" <?= getColorError($error, "login")?>" id="email_login" placeholder="Ingresa tu correo" required autocomplete="email" value="<?=restoreFormData($userLogin, "email")?>">
                        </div>
                        <div class="form__field">
                            <label for="password_login" id="contrasena">Contraseña</label>
                            <div class="form__password <?= getColorError($error, "login")?>">
                                <input type="password" name="password_login" id="password_login" placeholder="Ingresa tu contraseña" required autocomplete="current-password">
                                <img src="../img/icons/eye-off.svg" width="30" alt="" id="password_see">
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="/pages/recoverPassword.php" class="form__forget" id="olvidar">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="form__submit">
                        <span class="form__submit-text" id="boton">Entrar</span>
                        <span class="form__decoration"></span>
                    </button>

                    <div class="form__no-account">
                        <a href="register.php" id="no-acc">¿No tienes cuenta?</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <img src="../img/login/bg.jpg" alt="" class="img">

    <footer class="footer">
        <p class="footer__text" id="footer">MUO - Todos los derechos reservados</p>
    </footer>

    <script src="../js/login.js"></script>
    <script src="../js/general.js" type="module"></script>
</body>

</html>
<?php

?>