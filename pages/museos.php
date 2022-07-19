<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" content="Un sitio web de museos">
    <title>MUO - MUSEOS</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <!--Js-->
    <link rel="preload" href="../js/app.js" as="script">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">

    <!--General Styles for responsive Header-->
    <link rel="preload" href="../css/header-footer/mobile.css" as="style">
    <link rel="preload" href="../css/header-footer/tablet.css" as="style">
    <link rel="preload" href="../css/header-footer/desktop.css" as="style">

    <link rel="stylesheet" href="../css/header-footer/mobile.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/header-footer/tablet.css" media="(min-width: 742px) and (max-width: 1023px)">
    <link rel="stylesheet" href="../css/header-footer/desktop.css" media="(min-width: 1024px)">

    <!--Museum Style-->
    <link rel="stylesheet" href="../css/museos/mobile/style.css" media="(max-width:741px)">
    <link rel="stylesheet" href="../css/museos/tablet/style.css" media="(min-width:742px) and (max-width: 1023px)">
    <link rel="stylesheet" href="../css/museos/desktop/style.css" media="(min-width: 1024px)">

</head>
<body data-page="museos" >
    
    <?php  include "../includes/templates/header.php" ?>

    <section class="hero line">
        <div class="hero__wrapper">
            <div class="hero__text">
                <h1 class="hero__title" id="titulo">
                    Museos de El Salvador
                </h1>
                <p class="hero__description" id="description">
                    Descubre los diferentes museos que hacen posible MUO
                </p>
            </div>
            <div class="hero__img-container">
                <div class="hero__img-wrapper">
                    <img src="../img/museos/main-1.jpg" alt="" class="hero__img">
                    <img src="../img/museos/main-2.jpg" alt="" class="hero__img hero__img--down">
                    <img src="../img/museos/main-3.jpg" alt="" class="hero__img">
                </div>
                <div class="hero__autor">
                    <p id="credits">Imagen por</p>
                    <img src="../img/home/firma-grey.svg" alt="">
                        
                </div>
            </div>
        </div>
    </section>  

    <main class="main">
        <div class="main__wrapper">
            <div class="main__scroll">
                <div class="main__card-container">
                    <section class="main__card main-1">
                        <img src="../img/museos/main-1.jpg" alt="Imagen del Museo MARTE">
                        <div class="main__card-text">
                            <h2>MUSEO EL NIÑO FELIZ</h2>
                        </div>
                        <div class="main__card-autor">
                            <p>Imagen por: </p>
                            <img src="../img/home/firma-grey.svg" alt="Firma del fotografo @Camaro27">
                        </div>
                    </section>
                    <section class="main__card main-2 " >
                        <img src="../img/museos/main-2.jpg" alt="Imagen del Museo MARTE">
                        <div class="main__card-text">
                            <h2>MUSEO EL NIÑO FELIZ</h2>
                        </div>
                        <div class="main__card-autor">
                            <p>Imagen por: </p>
                            <img src="../img/home/firma-grey.svg" alt="Firma del fotografo @Camaro27">
                        </div>
                    </section>
                    <section class="main__card main-3">
                        <img src="../img/museos/main-3.jpg" alt="Imagen del Museo MARTE">
                        <div class="main__card-text">
                            <h2>MUSEO EL NIÑO FELIZ</h2>
                        </div>
                        <div class="main__card-autor">
                            <p>Imagen por: </p>
                            <img src="../img/home/firma-grey.svg" alt="Firma del fotografo @Camaro27">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php  include "../includes/templates/footer.php"?>
</body>
</html>