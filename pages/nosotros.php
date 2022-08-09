<?php  
include "../includes/app.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" content="Sobre nosotros MUO">
    <title>MUO - Nosotros</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">


    <!-- Footer  -->
    <link rel="stylesheet" href="../css/footer/mobile/style.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/footer/desktop/style.css" media="(min-width: 742px)">



    <!--About us Styles -->
    <link rel="preload" href="../css/nosotros/mobile/style.css" as="style">
    <link rel="stylesheet" href="../css/nosotros/mobile/style.css" media="(max-width: 741px)">
    <link rel="preload" href="../css/nosotros/desktop/style.css" as="style">
    <link rel="stylesheet" href="../css/nosotros/desktop/style.css" media="(min-width: 742px)">

</head>

<body data-page="nosotros">


<?php 
showHeader();
?>


    <main class="main">
        <section class="about">
            <div class="about__wrapper">
                <h1 class="about__heading" id="title">Sobre Nosotros</h1>

                <div class="about__container">
                    <div class="about__description">
                        <p id="description">
                            MUO es una sitio web que mantiene la cultura de El Salvador y la intenta mantener para las futuras generaciones.
                        </p>
                    </div>
                    <div class="about__img-container">
                        <img src="../img/nosotros/about-us.jpg" alt="Imagen referente a un museo">
                        <div class="about__autor">
                            <p id="credits">Imagen por</p>
                            <img src="../img/home/firma.svg" alt="Firma del fotografo (@Camaro27)">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="our">
            <div class="our__wrapper">
                <div class="our__border-bottom">
                    <div class="our__options">


                        <input class="our__input-mision" type="radio" name="option" onclick="showContent(this)" id="mision"
                            checked>
                        <label for="mision">
                            <div class="our__btn">
                                <h2>Mision</h2>
                            </div>
                        </label>
    
                        <input class="our__input-vision" type="radio" name="option" onclick="showContent(this)" id="vision">
                        <label for="vision">
                            <div class="our__btn">
                                <h2>Vision</h2>
                            </div>
                        </label>
    
                        <input class="our__input-personal" type="radio" name="option" onclick="showContent(this)"
                            id="personal">
                        <label for="personal">
                            <div class="our__btn">
                                <h2>Personal</h2>
                            </div>
                        </label>
    
    
                    </div>
                </div>

                <div class="our__content">

                    <section class="details mision">
                        <div class="details__text">
                            <div class="details__title">
                            <h3 id="our-mision">¿Cual es nuestra mision?</h3>
                        </div>
                        <div class="details__description">
                            <p id="our-mision-text">Nuestra mision es mantener y transmitir la cultura de El Salvador para que las siguientes generaciones no esten desinformadas de nuestras raices culturales </p>
                        </div>
                        </div>

                        <img class="details__img" src="../img/icons/mision.svg" alt="mision icono">

                    </section>
                    <section class="details vision">
                        <div class="details__text">
                            <div class="details__title">
                            <h3 id="our-vision">¿Cual es nuestra Vision?</h3>
                        </div>
                        <div class="details__description">
                            <p id="our-vision-text">Ser un sitio web nacionalmente reconocido ademas ofrecer la informacion culturar mas acertada y veridica </p>
                        </div>
                        </div>

                        <img class="details__img" src="../img/icons/vision.svg" alt="vision-icono">
                    </section>
                    <section class="details personal">
                        <div class="details__text">
                            <div class="details__title">
                            <h3 id="our-personal">Nuestro Personal</h3>
                        </div>
                        <div class="details__description">
                            <p id="our-personal-text">Grupo 5 - Creaj - Primer Año Seccion B Desarollo de Software </p>
                        </div>
                        </div>

                        <img class="details__img" src="../img/icons/personal.svg" alt="personal-icono">
                    </section>

                </div>


            </div>
        </section>
        <section class="logo">

        </section>
    </main>


    <?php  include "../includes/templates/footer.php"?>
    <script src="../js/about.js"></script>
</body>

</html>