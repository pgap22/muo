<?php
include "../includes/functions.php";
// session_start();
// $_SESSION["user_id"] = 1;
protegerIndex();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" co ntent="Un sitio web de museos">
    <title>MUO - INICIO</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <!--Js-->
    <link rel="preload" href="../js/app.js" as="script">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">

    <!-- Footer -->
    <link rel="stylesheet" href="../css/footer/mobile/style.css" media='(max-width: 741px)'>
    <link rel="stylesheet" href="../css/footer/desktop/style.css" media='(min-width: 742px)'>

    <!--Home Style-->
    <link rel="preload" href="../css/home/mobile/style.css" as="style">
    <link rel="preload" href="../css/home/tablet-desktop/style.css " as="style">
    <link rel="stylesheet" href="../css/home/mobile/style.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/home/tablet-desktop/style.css " media="(min-width: 742px)">

</head>

<body data-page="index">

    <?php include "../includes/templates/header.php" ?>


    <section class="hero">
        <div class="cta">
            <h1 class="cta__title" id="h1-hero">
                Empieza a ver la espectacular cultura que nos rodea
            </h1>
            <!--No se si agregar esto  Las buenas cosas solo están vivas cuando se recuerdan, no dejemos morir la cultura de El Salvador.-->
            <p class="cta__description" id="text-hero">Explora diferentes ilustraciones de arte, conocimiento humano, historia y mucho más. Muchas personas no conocen acerca de la cultura que rodea a El Salvador, ¿Qué esperas para que tú la conozcas?</p>
            <div class="cta__btn">
                <a href="register.php" id="btn-hero">Culturizate ya!</a>
            </div>
        </div>
        <div class="grid">
            <div class="grid__item">
                <figure class="grid__card">
                    <img src="../img/hero/escultura.webp" alt="Tren" title="Tren" class="card__img">
                    <figcaption>
                        <p class="grid__text"><span id="credits">Imagen por</span> <a href="https://www.flickr.com/people/camaro27"
                                target="_blank">@Camaro27</a>
                        </p>
                    </figcaption>
                </figure>
            </div>

            <div class="grid__item">
                <figure class="grid__card">
                    <img src="../img/hero/sombrero.webp" alt="Tren" title="Tren" class="card__img">
                    <figcaption>
                        <p  class="grid__text "><span id="credits">Imagen por</span> <a href="https://www.flickr.com/people/camaro27"
                                target="_blank">@Camaro27 </a>
                        </p>
                    </figcaption>
                </figure>
            </div>

            <div class="grid__item">
                <figure class="grid__card">
                    <img src="../img/hero/cara.webp" alt="Tren" title="Tren" class="card__img">
                    <figcaption>
                        <p  class="grid__text "><span id="credits">Imagen por</span> <a href="https://www.flickr.com/people/camaro27"
                                target="_blank">@Camaro27</a>
                        </p>
                    </figcaption>
                </figure>
            </div>

            <div class="grid__item">
                <figure class="grid__card">
                    <img src="../img/hero/tren.webp" alt="Tren" title="Tren" class="card__img">
                    <figcaption>
                        <p  class="grid__text "><span id="credits">Imagen por</span> <a href="https://www.flickr.com/people/camaro27"
                                target="_blank">@Camaro27</a>
                        </p>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <main class="main">
        <section class="why-us">
            <div class="why-us__heading">
                <h2 id="question">¿Que nos diferencia de un museo tradicional ?</h2>
            </div>
            <div class="why-us__container">
                <div class="why-us__card">
                    <div class="why-us__icon">
                        <img src="../img/icons/quality.svg" alt="Calidad" title="Calidad">
                    </div>
                    <div class="why-us__title">
                        <h3 id="quality-title">Calidad</h3>
                    </div>
                    <div class="why-us__description">
                        <p id="quality-text">
                            La información que nosotros brindamos a nuestros usuarios son de fuentes fiables. Nosotros sabemos lo que nuestra cultura vale.
                        </p>
                    </div>
                </div>
                <div class="why-us__card">
                    <div class="why-us__icon">
                        <img src="../img/icons/digital.svg" alt="Digital" title="Digital">
                    </div>
                    <div class="why-us__title">
                        <h3 id="digital-title">Digital</h3>
                    </div>
                    <div class="why-us__description">
                        <p id="digital-text">
                            Sabemos lo difícil lo que puede ser ir a museo en estos tiempos, así que ofrecemos nuestro contenido de manera digital con la finalidad que sea fácil de acceder.
                        </p>
                    </div>
                </div>
                <div class="why-us__card">
                    <div class="why-us__icon">
                        <img src="../img/icons/free.svg" alt="Gratis" title="Gratis">
                    </div>
                    <div class="why-us__title">
                        <h3 id="free-title">Gratis</h3>
                    </div>
                    <div class="why-us__description">
                        <p id="free-text">
                            El contenido que nosotros vamos a ofrecer es gratuito, con tan solo una cuenta registrada en MUO tendras acceso a todo lo que ofrecemos.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="our-content">
            <h2 class="our-content__heading" id="revive">Revive la experiencia de un museo</h2>
            <article class="our-content__article our-content--grid">
                <div class="our-content__text">
                    <h3 class="our-content__title" id="revive-title">Descubriendo el arte que expresa la cultura salvadoreña</h3>

                    <p class="our-content__description" id="revive-text">Encontraremos diversas piezas creativas donde lo que se busca es
                        la conservación y exposición de obras de arte de diferentes modalidades, como lo pueden ser:
                        pintura, dibujo, esculturas y otras.</p>
                </div>

                <div class="our-content__img">
                    <div class="our-content__img-container">
                        <div class="our-content__carrusel">
                            <img src="../img/home/arte.webp" alt="">
                            <img src="../img/home/arte2.webp" alt="">
                            <img src="../img/home/arte3.webp" alt="">
                            <img src="../img/home/arte4.webp" alt="">
                        </div>
                    </div>
                    <div class="our-content__autor">
                        <p id="credits">Imagen por</p>
                        <img src="../img/home/firma.svg" alt="">
                    </div>
                    <div class="our-content__btns art">
                        <input type="radio" name="arte" checked id="1-a" onclick="firstScroll(this)">
                        <label for="1-a"></label>

                        <input type="radio" name="arte" id="2-a" onclick="secondScroll(this)">
                        <label for="2-a"></label>

                        <input type="radio" name="arte" id="3-a" onclick="thirdScroll(this)">
                        <label for="3-a"></label>

                        <input type="radio" name="arte" id="4-a" onclick="fourthScroll(this)">
                        <label for="4-a"></label>
                    </div>
                </div>

            </article>
            <article class="our-content__article our-content--grid">
                <div class="our-content__text">
                    <h3 class="our-content__title" id="revive1-title">Los diferentes sucesos militares que marcaron una nacion</h3>
                    <p class="our-content__description" id="revive1-text">Descubriremos diferentes sucesos que fueron ocurridos en nuestro país en los siglos XVIII,XIX y SXX, dicho museo cuenta con 10 salas de exhibición donde encontraremos: armas, uniformes e monumentos.</p>
                </div>

                <div class="our-content__img">
                    <div class="our-content__img-container ">
                        <div class="our-content__carrusel">
                            <img src="../img/home/militar1.jpg" alt="">
                            <img src="../img/home/militar2.jpg" alt="">
                            <img src="../img/home/militar3.jpg" alt="">
                            <img src="../img/home/militar4.jpg" alt="">
                        </div>
                    </div>
                    <div class="our-content__autor">
                        <p id="credits">Imagen por</p>
                        <img src="../img/home/firma.svg" alt="">
                    </div>
                    <div class="our-content__btns militar">
                        <input type="radio" name="militar" checked id="1-m" onclick="firstScroll(this)">
                        <label for="1-m"></label>

                        <input type="radio" name="militar" id="2-m" onclick="secondScroll(this)">
                        <label for="2-m"></label>

                        <input type="radio" name="militar" id="3-m" onclick="thirdScroll(this)">
                        <label for="3-m"></label>

                        <input type="radio" name="militar" id="4-m" onclick="fourthScroll(this)">
                        <label for="4-m"></label>
                    </div>
                </div>

            </article>
            <article class="our-content__article our-content--grid">
                <div class="our-content__text">
                    <h3 class="our-content__title" id="revive2-title">Diversos descubrimientos cientificos en un solo lugar</h3>
                    <p class="our-content__description" id="revive2-text">
                    Dicho museo de historia natral es una institución científica el cual su objetivo es investigar y
                        mostrar la diversidad biológica e paleontológica del país.
                    </p>
                </div>

                <div class="our-content__img">
                    <div class="our-content__img-container ">
                        <div class="our-content__carrusel">
                            <img src="../img/home/natural1.jpg" alt="">
                            <img src="../img/home/natural2.jpg" alt="">
                            <img src="../img/home/natural3.jpg" alt="">
                            <img src="../img/home/natural4.jpg" alt="">
                        </div>
                    </div>
                    <div class="our-content__autor">
                        <p id="credits">Imagen por</p>
                        <img src="../img/home/firma.svg" alt="">
                    </div>
                    <div class="our-content__btns ciencia">
                        <input type="radio" name="ciencia" checked id="1-c" onclick="firstScroll(this)">
                        <label for="1-c"></label>

                        <input type="radio" name="ciencia" id="2-c" onclick="secondScroll(this)">
                        <label for="2-c"></label>

                        <input type="radio" name="ciencia" id="3-c" onclick="thirdScroll(this)">
                        <label for="3-c"></label>

                        <input type="radio" name="ciencia" id="4-c" onclick="fourthScroll(this)">
                        <label for="4-c"></label>
                    </div>
                </div>

            </article>
        </section>

        <section class="cta-two">

            <div class="cta-two__container">
                <div class="cta-two__circle">
                    <svg width="32" fill="white" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0 32V29.6H3.32V13.16H0V11.28L16 0L32 11.28V13.16H28.72V29.6H32V32H0ZM5.72 29.6H16.04H26.32H5.72ZM9.76 25.56H12.16V18.2L16 24L19.88 18.2V25.56H22.28V14.6H19.68L16 20.2L12.32 14.6H9.76V25.56ZM26.32 29.6V10.2L16 2.96L5.72 10.2V29.6H26.32Z" />
                    </svg>
                </div>
                <div class="cta-two__content">
                    <h3 class="cta-two__text" id="cta2-title">Que esperas para visualizar nuestra cultura de una forma digital ?</h3>
                    <a class="cta-two__btn" href="register.php" id="cta2-text">Crear una cuenta !</a>
                </div>
            </div>

        </section>
    </main>

    <?php  include "../includes/templates/footer.php"?>
    

    <script src="../js/app.js"></script>
    <script src="../js/general.js" type="module"></script>

    <!--Termine el home :D-->
    <!--ola-->
</body>

</html>