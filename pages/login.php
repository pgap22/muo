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

<body>
    <header class="header">
        <div class="header__container">
            <div class="header__back">
                <a href="/"><img src="../img/icons/arrowLeft.svg" alt="" class="header__back--button"></a>
            </div>
            <a href="../html/index.html">
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
                <h1 class="main__title">Iniciar Sesion</h1>
                <p class="main__description">Continua explorando nuestros origenes para dominar la corriente de nuestras
                    fronteras</p>
            </section>
            <div class="main__form">
                <form action="/" class="form">
                    <div class="form__inputs">
                        <div class="form__field">
                            <label for="email_login">Email</label>
                            <input autofocus type="email" name="email_login" id="email_login" placeholder="Ingresa tu correo"  required autocomplete="email">
                        </div>
                        <div class="form__field">
                            <label for="password_login">Contraseña</label>
                            <div class="form__password">
                                <input type="password" name="password_login" id="password_login"
                                    placeholder="Ingresa tu contraseña"  required autocomplete="current-password">
                                <img src="../img/icons/eye-off.svg" width="30" alt="" id="password_see">
                            </div>
                        </div>
                    </div>

                    <div>
                        <a href="#" class="form__forget">¿Olvidaste tu contraseña?</a>
                    </div>

                    <input class="form__submit" type="submit" name="submit_login" value="Entrar">

                    <div class="form__no-account">
                        <a href="register.php">¿No tienes cuenta?</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <img src="../img/login/bg.jpg" alt="" class="img">

    <footer class="footer">
        <p class="footer__text">MUO - Todos los derechos reservados</p>
    </footer>

    <script src="../js/login.js"></script>
    <script src="../js/general.js"></script>
</body>

</html>