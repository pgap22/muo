<?php
include "../includes/app.php";

protegerHome();

if(isset($_GET["expo-search"])){
    if(!$_GET["expo-search"]){
        header("location: /home");
    }
}


$search = $_GET["expo-search"];


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
    <script>
        history.scrollRestoration = "manual"
    </script>

    <!-- addFav -->
    <script src="/js/componentHandler.js" type="module"></script>
    <script src="/js/alert.js"></script>
    <script src="/js/addFav.js"></script>

    <!-- Search css -->
    <link rel="stylesheet" href="../css/search/mobile/style.css" media="(max-width: 520px)">
    <link rel="stylesheet" href="../css/search/tablet/style.css" media="(min-width: 520px) and (max-width: 1024px)">
    <link rel="stylesheet" href="../css/search/desktop/style.css" media="(min-width: 1024px)">


</head>

<body data-page="search" data-search="<?= $search ?>">


    <?php
    showHeader();
    ?>

    <main class="main">
        <div class="main__container">

            <?= menuHome('main__selected-page','','') ?>

            <div class="main__content wrapper">
                <div class="search-container">
                    <h1 id="result">Resultados</h1>
                    <div class="search-result">
                        
                    </div>
                </div>
            </div>


        </div>

        </div>
    </main>
<script defer src="/js/resultSearch.js"></script>

    <?= menuMobilHome('menu-phone__icon--active','','') ?>

</body>
</html>