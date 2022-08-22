<?php

use MUO\Museos;

include "../includes/app.php";
session_start();
if (isset($_SESSION["user_id"])) {
    $userID = $_SESSION["user_id"];
    protegerUserPage($userID);
}
$museos = Museos::all();

?>

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


    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">


    <!-- Footer -->
    <link rel="stylesheet" href="../css/footer/mobile/style.css" media='(max-width: 741px)'>
    <link rel="stylesheet" href="../css/footer/desktop/style.css" media='(min-width: 742px)'>

    <!--Museum Style-->
    <link rel="stylesheet" href="../css/museos/mobile/style.css" media="(max-width:741px)">
    <link rel="stylesheet" href="../css/museos/tablet/style.css" media="(min-width:742px) and (max-width: 1023px)">
    <link rel="stylesheet" href="../css/museos/desktop/style.css" media="(min-width: 1024px)">

</head>

<body data-page="museos">


    <?php
    showHeader();
    ?>

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
                    <?php foreach ($museos as $museo) { ?>
                        <a href="./museo.php?id=<?=$museo->id ?>">
                        <section class="main__card main-scroll">
                            <img class="main__card-img" src="<?=$museo->imagen ?>" alt="Imagen del Museo MARTE">
                            <div class="main__card-text">
                                <h2><?= $museo->nombre ?></h2>
                            </div>
                            <div class="main__card-autor">
                                <p id="credits">Imagen por: </p>
                                <img src="../img/home/firma-grey.svg" alt="Firma del fotografo @Camaro27">
                            </div>
                        </section>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <?php include "../includes/templates/footer.php" ?>
</body>

</html>