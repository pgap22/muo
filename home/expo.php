<?php
include "../includes/app.php";
protegerHome();
#Detectar Expo y sino redireccionar

use MUO\Comentarios;
use MUO\Exposiciones;
use MUO\Favoritos;
use MUO\Imagenesexpo;
use MUO\Usuarios;

if (!isset($_GET["id"])) {
    header("location: /home");
}
$id = $_GET["id"];
$expo = Exposiciones::find($id);
if (!$expo) {
    header("location: /home");
}


$imagenes = Imagenesexpo::where("id_exposicion", $expo->id, 0);


#Obteniendo Comentarios
$comentarios = Comentarios::where('id_exposicion', $id, 0);
if(!$comentarios){
    $comentarios = [];
}

$userID = $_SESSION["user_id"];
$query = Favoritos::executeSQL("SELECT * FROM favoritosusuarios WHERE id_usuario = $userID AND id_exposicion = $id");
$result = Favoritos::fetchResultSQL($query);

if($result){
    $icon = "/img/icons/favAdded.svg"; 
}
else{
    $icon = "/img/icons/favorite.svg"; 
}



$_SESSION["id_expo"] = $id;
$msg = $_SESSION["alert"]["message"] ?? '';
$title = $_SESSION["alert"]["title"] ?? '';
$type = $_SESSION["alert"]["type"] ?? '';
$alert = $_SESSION["alert"]["alert"] ?? '';

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
    <link rel="stylesheet" href="../css/homePage/tablet/style.css" media="(min-width: 521px) and (max-width: 1023px)">
    <link rel="stylesheet" href="../css/homePage/desktop/style.css" media="(min-width: 1024px)">

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

    <!-- add fav -->
    <script src="/js/addFav.js"></script>


</head>

<body data-page="expo" data-id="<?= $id ?>">


    <?php
    showHeader();
    ?>

    <main class="main">
        <div class="main__container center">

            <?= menuHome('main__selected-page','','') ?>

            <div class="main__expo">
                <div class="main__expo-top">
                    <h1 class="main__expo-title" id="name"><?= $expo->nombre ?></h1>
                    <div class="btn-fav" onclick="addFav(<?= $id ?>,this)">
                        <img src="<?= $icon?>" alt="">
                    </div>
                    
                </div>

                <div class="carusel-expo">
                    <div class="carusle-expo__img-container">
                        <img src="" alt="" class="carusel-expo__img" data-position=0>
                        <div class="carusel-expo__btn">
                            <img src="/img/icons/nextIco.svg" alt="" class="carusel-expo__back" onclick="back()">
                            <img src="/img/icons/nextIco.svg" alt="" class="carusel-expo__next" onclick="next()">
                        </div>
                    </div>
                    <div class="carusel-expo__more-img">
                        <?php foreach ($imagenes as $img) { ?>
                            <img src="<?= $img->rutaImagen ?>" class="carusel-expo__other-img" alt="">
                        <?php } ?>
                    </div>
                    <p class="carusel-expo__info" id="info">
                        <?= $expo->informacion ?>
                    </p>
                </div>

            </div>


            <div class="main__wrapper-comments">
                <div class="main__comments">
                    <h2>Comentarios</h2>
                    <?= sendAlert($alert, $msg, $title, $type) ?>
                    <div class="main__comment-container">
                        <form action="addComment.php" method="POST" class="add-comment">
                            <label for="addcomment">Enviar comentario</label>
                            <textarea name="comment" id="addcomment" rows="5" class="add-comment__input"></textarea>

                            <button class="add-comment__submit" type="submit">
                                <img src="/img/icons/send.svg" alt="" class="add-comment__icon">
                            </button>

                        </form>
                    </div>
                </div>


                <?php  ?>
                <?php foreach ($comentarios as $comentario) { ?>
                    <div class="comment-wrapper">
                        <div class="comment">
                            <img class="comment__icon" src="/img/icons/user.svg" alt="">
                            <div class="comment__data">
                                <p class="comment__name"><span><?= Usuarios::find($comentario->id_usuario)->name ?></span><span><?= Usuarios::find($comentario->id_usuario)->last_name ?></span></p>
                                <p class="commnet__text"><?= $comentario->contenido?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>


            </div>




    </main>

    
    <?= menuMobilHome('menu-phone__icon--active','','') ?>

    <script src="/js/componentHandler.js" type="module"></script>
    <script src="/js/expoImg.js"></script>
    <script src="/js/expoTranslate.js" defer></script>
    <script src="/js/alert.js"></script>

</body>

</html>