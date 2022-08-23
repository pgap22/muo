<?php

use MUO\Exposiciones;
use MUO\Favoritos;
use MUO\Imagenesexpo;

include "../includes/app.php";

protegerHome();

$userID = $_SESSION["user_id"];

$favoritos = Favoritos::where("id_usuario", $userID, 0);

if(!$favoritos){
    $favoritos = [];
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
    <title>MUO - Favoritos</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <!-- Home css -->
    <link rel="stylesheet" href="../css/homePage/mobile/style.css" media="(max-width: 520px)">
    <link rel="stylesheet" href="../css/homePage/tablet/style.css" media="(min-width: 520px) and (max-width: 1024px)">
    <link rel="stylesheet" href="../css/homePage/desktop/style.css" media="(min-width: 1024px)">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">

    <!-- avoid auto scroll -->
    <script>
        history.scrollRestoration = "manual"
    </script>

    <!-- Favorite -->
    <link rel="stylesheet" href="/css/favorite/mobile/style.css" media="(max-width: 520px)">
    <link rel="stylesheet" href="/css/favorite/tablet/style.css" media="(min-width: 520px) and (max-width: 1024px)">
    <link rel="stylesheet" href="/css/favorite/desktop/style.css" media="(min-width: 1024px)">


</head>

<body data-page="favorite">


    <?php
    showHeader();
    ?>

    <main class="main">
        <div class="main__container">

            <?= menuHome('', 'main__selected-page', '') ?>


            <div class="favorite wrapper">
                <h1 class="favorite__title" id="title">Tus Favoritos</h1>
                   
                    <?php if(!$favoritos){ ?>
                        <p id="nothing">No tienes exposiciones guardadas en favoritos :(</p>
                    <?php } ?>

                <div class="favorite__container">

                    <?php foreach ($favoritos as $fav) { ?>

                        <?php $favID = $fav->id_exposicion ?>
                        <?php $favorite = Exposiciones::find($favID) ?>
                        <?php $img = Imagenesexpo::where("id_exposicion", $favID) ?>
                        
                        <a href="/home/expo.php?id=<?= $favorite->id ?>" class="favorite__redirect">
                            <img src="<?= $img->rutaImagen ?>" alt="" class="favorite__img">
                            <p class="favorite__name">Ver</p>
                        </a>

                    <?php } ?>

                   
                </div>
            </div>


        </div>

        </div>
    </main>

    <?= menuMobilHome('', 'menu-phone__icon--active', '') ?>


</body>

</html>