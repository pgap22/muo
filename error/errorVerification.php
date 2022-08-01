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

<body data-page="verf-error-mail">

    <main>
        <div class="verification">
            <picture class="verification__logo">
                <source srcset="../img/logo/logo.svg" media="(min-width: 742px)">
                <img src="../img/logo/logo-mobile.svg" alt="logo de MUO">
            </picture>
            <div class="verification__text">
                <h1 class="verification__title" id="title">
                    Error en la verificacion
                </h1>
                <p class="verification__wrong-mail" id="text">Hubo un error con la verificacion o el email ya esta verificado</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/error.svg" alt="error Icon" class="verification__error">
            </div>
            
            <a href="/" class="verification__button">
                        <span class="verification__button-text" id="button">Volver al inicio</span>
                        <span class="verification__decoration"></span>
            </a>
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
</body>

</html>