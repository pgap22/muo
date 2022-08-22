<?php
include "../includes/app.php";

#Detectar Expo y sino redireccionar
use MUO\Imagenesexpo;
use MUO\Museos;

if (!isset($_GET["id"])) {
    header("location: /");
}

$id = $_GET["id"];

$museo = Museos::find($id);

if (!$museo) {
    header("location: /");
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
    <title>MUO -  <?= $museo->nombre?></title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">


    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">

    <!-- explore  -->
    <link rel="stylesheet" href="/css/expo/mobile/style.css" media="(max-width: 520px)">
    <link rel="stylesheet" href="/css/expo/tablet/style.css" media="(min-width: 521px) and (max-width: 1023px)">
    <link rel="stylesheet" href="/css/expo/desktop/style.css" media="(min-width: 1024px)">

</head>

<body data-page="museo-info" data-id="<?= $museo->id ?>">


    <?php
    showHeader();
    ?>

    <main class="main">
        <div class="main__container">
            <div class="main__expo">
                <h1 class="main__expo-title"><?= $museo->nombre ?></h1>

                <div class="carusel-expo">
                    <div class="carusle-expo__img-container">
                        <img src="" alt="" class="carusel-expo__img" data-position=0>
                        <div class="carusel-expo__btn">
                            <img src="/img/icons/nextIco.svg" alt="" class="carusel-expo__back" onclick="back()">
                            <img src="/img/icons/nextIco.svg" alt="" class="carusel-expo__next" onclick="next()">
                        </div>
                    </div>
                    <div class="carusel-expo__more-img">
                        <img src="<?= $museo->imagen?>" class="carusel-expo__other-img" alt="">
                    </div>
                    <p class="carusel-expo__info" id="info">
                        <?= $museo->descripcion?>
                    </p>
                </div>

            </div>

        </div>
    </main>

    <?php if(isset($_SESSION["user_id"])){ ?>
        <div class="menu-phone no-tablet">
        <div class="menu-phone__container">
            <div class="menu-phone__icon menu-phone__icon--active">
                <img src="../img/icons/feed.svg" alt="" class="menu-phone__icon-img ">
            </div>
            <div class="menu-phone__icon">
                <img src="../img/icons/favorite.svg" alt="" class="menu-phone__icon-img ">
            </div>
            <div class="menu-phone__icon">
                <img src="../img/icons/explore.svg" alt="" class="menu-phone__icon-img ">
            </div>
            <div class="menu-phone__icon">
                <img src="../img/icons/search.svg" alt="" class="menu-phone__icon-img ">
            </div>
        </div>
    </div>
    <?php } ?>
<script src="/js/expoImg.js"></script>
</body>
</html>