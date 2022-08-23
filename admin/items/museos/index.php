<?php

use MUO\Museos;
use MUO\MuseosEn;

include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if (isset($userID)) {
    protegerAdmin($userID);
} else {
    header("location: /");
}

$msg = $_SESSION["alert"]["message"] ?? '';
$title = $_SESSION["alert"]["title"] ?? '';
$type = $_SESSION["alert"]["type"] ?? '';
$alert = $_SESSION["alert"]["alert"] ?? '';

#Obtener los museos
$museos = Museos::all();
if(!$museos){
    $museos = [];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - PANEL MUSEOS</title>

    <!-- css -->
    <link rel="stylesheet" href="/css/general/general.css">
    <link rel="stylesheet" href="/fonts/font.css">

    <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 480px) and (max-width: 1024px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <link rel="stylesheet" href="/css/adminRead/mobile/style.css">

</head>

<body data-page="admin-museo" data-item="museos" data-api="museos">
    <?php include "../../../includes/templates/headerAdmin.php" ?>

    <?= sendAlert($alert, $msg, $title, $type) ?>

    <div class="center">
        <main class="main">
            <div class="main__container">
                <div class="main__top">
                    <h1 class="main__title" id="title">
                        Museos
                    </h1>

                    <a href="/" class="main__go-back" id="volver">
                        Volver
                    </a>
                </div>

                <div class="main__items">
                    <a href="/admin/items/museos/add.php" class="main__add">
                        <img src="/img/icons/add.svg" alt="Add icon" class="main__add-icon">
                        <p class="main__add-text" id="add">Agregar Museo</p>
                    </a>
                </div>
                <div class="main__table-wrapper">
                    <table class="main__table">
                        <tr class="main__table-header">
                            <th class="main__table-th">
                                <p class="main__th">ID</p>
                            </th>
                            <th class="main__table-th">
                                <p class="main__th" id="name">Nombre</p>
                            </th>
                            <th class="main__table-th">
                                <p class="main__th" id="descripcion">Descripcion</p>
                            </th>
                            <th class="main__table-th">
                                <p class="main__th" id="imagen">Imagen</p>
                            </th>
                            <th class="main__table-th">
                                <p class="main__th" id="acciones">Acciones</p>
                            </th>
                        </tr>
                        <?php foreach($museos as $museo){ ?>
                            <tr class="main__data">
                                <td class="main__td"><?=$museo->id?></td>
                                <td class="main__td min-w-name"><?=$museo->nombre?></td>
                                <td class="main__td min-w-td"><p><?= ($_SESSION["lang"] == "es") ? $museo->descripcion : MuseosEn::where("id_museo", $museo->id)->descripcion?></p></td>
                                <td class="main__td">
                                    <img src="<?=$museo->imagen?>" alt="" class="main__td-image">
                                </td>
                                <td class="main__td">
                                        <div class="main__actions-wrapper two-action">
                                            <a href="/admin/items/museos/edit.php?id=<?=$museo->id?>" class="main__action bc-a">
                                                <img src="/img/icons/edit.svg" class="main__action-icon" alt="">
                                            </a>
                                            <div class="main__action bc-r delete-btn" id=<?=$museo->id?> onclick="getItem(this)">
                                                <img src="/img/icons/delete.svg" class="main__action-icon" alt="">
                                            </div>
                                        </div>
                                </td>
                            </tr>
                        <?php }  ?>
                        <!-- Datos -->
                        <!-- <tr class="main__data">
                            <td class="main__td">1</td>
                            <td class="main__td min-w-name">Museo jose maria ramos</td>
                            <td class="main__td min-w-td">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, possimus. Impedit, provident dicta minima nam laboriosam, repellat ratione blanditiis commodi temporibus quia deleniti hic ipsum sunt sint quasi nisi repudiandae autem voluptatum inventore! Accusamus sint ut eligendi consectetur reiciendis eius. Earum magni ratione accusamus optio perspiciatis porro nihil voluptas blanditiis!</td>
                            
                            <td class="main__td">
                                <img class="main__td-image" src="/museos/marte/monumento_revolucion/image.jpg" alt="">
                            </td>
                            <td class="main__td">
                                <div class="main__actions-wrapper two-action">
                                    <a href="/admin/items/museos/edit.php" class="main__action bc-a">
                                        <img src="/img/icons/edit.svg" class="main__action-icon" alt="">
                                    </a>
                                    <div class="main__action bc-r delete-btn">
                                        <img src="/img/icons/delete.svg" class="main__action-icon" alt="">
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                        <!-- Fin Datos -->
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="/js/alert.js"></script>
    <script src="/js/adminIndex.js"></script>
    <script src="/js/lang.js" type="module"></script>
</body>

</html>