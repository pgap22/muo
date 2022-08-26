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
    <title>MUO - PAGINA PRINCIPAL</title>
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
    <script>history.scrollRestoration = "manual"</script>

    <!-- addFav -->
    <script src="/js/componentHandler.js" type="module"></script>
    <script src="/js/alert.js"></script>
    <script src="/js/addFav.js"></script>

</head>

<body data-page="home">


    <?php
    showHeader();
    ?>

    <main class="main">
        <div class="main__container">

        <?= menuHome('main__selected-page','','') ?>

            <div class="main__content">
                <div class="main__feed-wrapper">
                    <h1 class="main__title" id="title">Bienvenido a MUO</h1>
                    <div class="main__feed">

                    </div>


                </div>
            </div>
            <div class="show-only-desktop no-mobile main__recommend">
                <h3 id="recommend">Exposiciones recomendadas</h3>
                <div class="expo-recommend"></div>
            </div>  
            
        </div>

    </div>
</main>

<?php  

?>

<?= menuMobilHome('menu-phone__icon--active','','') ?>

<script defer src="/js/infiniteScroll.js"></script>

</body>

</html>