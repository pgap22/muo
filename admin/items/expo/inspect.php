<?php

use MUO\Comentarios;
use MUO\Exposiciones;
use MUO\Favoritos;
use MUO\Imagenesexpo;
use MUO\Usuarios;

include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if (isset($userID)) {
    protegerAdmin($userID);
} else {
    header("location: /");
}

#Detectar si no existe id en la url
if (!isset($_GET["id"])) {
    if ($_SESSION["lang"] == "es") {
        $_SESSION["alert"]["message"] = "No se encontro el item!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    } else {
        $_SESSION["alert"]["message"] = "Item was not found!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }
    header("location: /admin/items/expo");
}

$id = $_GET["id"];

#Detectar si el item existe
$exposicion = Exposiciones::find($id);

#Detectar la primer imagen 
$imagen = Imagenesexpo::where("id_exposicion", $id)->rutaImagen;

#Detectar favoritos
$favoritos = Favoritos::executeSQL("SELECT count(*) FROM favoritosusuarios WHERE id_exposicion = $id");
$favoritos = Favoritos::fetchResultSQL($favoritos)["count(*)"];

#Detectar comentarios y numero de estos
$numComment = Comentarios::executeSQL("SELECT count(*) FROM comentarios WHERE id_exposicion = $id");
$numComment = Comentarios::fetchResultSQL($numComment)["count(*)"];

$comentarios = Comentarios::where("id_exposicion", $id, 0);
if (!$comentarios) {
    $comentarios = [];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css  -->
    <link rel="stylesheet" href="/css/general/general.css">
    <link rel="stylesheet" href="/fonts/font.css">


    <link rel="stylesheet" href="/css/adminInspect/mobile/style.css">
    <link rel="stylesheet" href="/css/adminInspect/desktop/style.css" media="(min-width: 768px)">

    <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 481px) and (max-width: 1023px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <title>MUO - PANEL</title>
</head>

<body data-page="admin-inspect">
    <?php include "../../../includes/templates/headerAdmin.php" ?>

    <main class="main">
        <div class="main__wrapper">
            <div class="main__top">
                <h1 class="main__title"><?= $exposicion->nombre ?></h1>
                <a class="main__go-back" href="/admin/items/expo" id="back">Volver</a>
            </div>
            <div class="main__museum-data">
                <div class="main__museum-general">
                    <img class="main__image" src="<?= $imagen ?>" alt="Museum Img">
                </div>


                <div class="main__stats-container">
                    <div class="main__stat">
                        <div class="main__data">
                            <p class="main__counter"><?= $numComment ?></p>
                            <p class="main__text-stat" id="comment">Comentarios</p>
                        </div>
                        <img class="main__icon-stats" src="/img/icons/com.svg" alt="Comment icon">
                    </div>

                    <div class="main__stat">
                        <div class="main__data">
                            <p class="main__counter"><?= $favoritos ?></p>
                            <p class="main__text-stat" id="fav">Añadidos a Favoritos</p>
                        </div>
                        <img class="main__icon-stats" src="/img/icons/favorite.svg" alt="Favorite Icon">
                    </div>

                </div>
            </div>

            <div class="main__comments-container">
                <h2 class="main__comment-title" id="comment-title">Comentarios</h2>
                <div class="main__comment-list">
                    <?php foreach ($comentarios as $comentario) { ?>
                        <!-- start comment  -->
                        <div class="main__comment">
                            <div class="main__user">
                                <img class="main__user-icon" src="/img/icons/user.svg" alt="User Icon">

                                <?php 
                                
                                $user = Usuarios::find($comentario->id_usuario);
                                
                                ?>

                                <div class="main__user-info">
                                    <p class="main__name"><?= $user->name ?>, <?=$user->last_name ?></p>
                                    <p class="main__comment-data"><?=$comentario->contenido ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- end commnet  -->
                    <?php } ?>
                </div>
            </div>

        </div>
    </main>

<script src="/js/lang.js" type="module"></script>
</body>

</html>