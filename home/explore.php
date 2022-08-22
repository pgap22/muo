<?php

include "../includes/app.php";

protegerHome();


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" content="Un sitio web de museos">
    <title>MUO - Explora</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <!-- Home css -->
    <link rel="stylesheet" href="../css/homePage/mobile/style.css" media="(max-width: 520px)">
    <link rel="stylesheet" href="../css/homePage/tablet/style.css" media="(min-width: 521px) and (max-width: 1023px)">
    <link rel="stylesheet" href="../css/homePage/desktop/style.css" media="(min-width: 1024px)">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">

    <!-- Favorite -->
    <link rel="stylesheet" href="/css/explore/mobile/style.css" media="(max-width: 520px)">
    <link rel="stylesheet" href="/css/explore/tablet/style.css" media="(min-width: 521px) and (max-width: 1023px)">
    <link rel="stylesheet" href="/css/explore/desktop/style.css" media="(min-width: 1024px)">


</head>

<body data-page="explore">


    <?php
    showHeader();
    ?>

    <main class="main">
        <div class="main__container">
            <?= menuHome('', '', 'main__selected-page') ?>

            <div class="wrapper flex">
                <h1 id="title">Explora</h1>


                <div class="selector-container">
                    <p class="selector__name" id="category">Categorias</p>
                    <label for="selector">
                        <div class="switch" id="0">
                            <div class="switch__ball"></div>
                        </div>
                    </label>
                    <input type="checkbox" hidden name="selector" id="selector">
                    <p class="selector__name" id="museum">Museos</p>
                </div>

                <div class="tags"></div>

                <div class="result-explore">

                </div>
            </div>
        </div>
    </main>

    <?= menuMobilHome('', '', 'menu-phone__icon--active') ?>

    <script defer src="/js/switch.js"></script>

</body>

</html>