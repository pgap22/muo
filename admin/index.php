<?php  
include "../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if(isset($userID)){
    protegerAdmin($userID);
}
else{
    header("location: /");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- css -->
    <link rel="stylesheet" href="/css/admin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/admin/tablet/style.css" media="(min-width: 480px) and (max-width: 1024px)">
    <link rel="stylesheet" href="/css/admin/desktop/style.css" media="(min-width: 1024px)">
    

        <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 480px) and (max-width: 1024px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">


    <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
    <!-- general css -->
    <link rel="stylesheet" href="../css/general/general.css">
    <link rel="stylesheet" href="../fonts/font.css">


    <title>MUO - PANEL</title>
</head>
<body data-page="admin-panel">

<?php include "../includes/templates/headerAdmin.php" ?>

    <main class="main">
        <div class="main__container">
                <div class="main__intro">
                    <h1 class="main__title" id="title">Panel de administracion de MUO</h1>
                </div>
        
            
            <div class="main__selectors">
                <p class="main__question" id="question">¿Que desea modificar?</p>
                <div class="main__wrapper">
                    <a href="/admin/items/museos" class="main__option">
                        <div class="main__options-bg">
                            <img src="../img/icons/museum.svg" alt="" class="main__img-option">
                        </div>
                        <p class="main__title-option" id="museo">Museos</p>
                    </a>
                    
                    <a href="/admin/items/categorias/" class="main__option">
                        <div class="main__options-bg">
                            <img src="../img/icons/categories.svg" alt="" class="main__img-option">
                        </div>
                        <p class="main__title-option" id="categoria">Categorias</p>
                    </a>
                    
                    <a href="/admin/items/expo/" class="main__option tablet-grid-last">
                        <div class="main__options-bg">
                            <img src="../img/icons/expo.svg" alt="" class="main__img-option">
                        </div>
                        <p class="main__title-option" id="expo">Exposiciones</p>
                    </a>
                </div>
            </div>

            <div class="main__lang">
                <h2 id="cambiar-idioma">Cambiar idioma</h2>
                
                <div class="lang">
                    <div class="lang__selected">
                        <div class="lang__data-selected">
                            <img src="/img/icons/language.svg" alt="" class="lang__icon">
                            <p class="lang__selected-text" id="es" data-primaryLang="es">Español</p>
                        </div>
                        <img src="/img/icons/expand_more.svg" alt="" class="lang__expand">
                    </div>
                    <div class="lang__options lang--hide">
                        <div class="lang__lang">
                            <img src="/img/icons/uk.svg" class="lang__flag" id="en">
                            <p class="lang__lang-text" data-secondLang="en">Ingles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script src="/js/lang.js" type="module"></script>
</body>
</html>