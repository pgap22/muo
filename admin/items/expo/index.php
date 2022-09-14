<?php

use MUO\CategoriaEng;
use MUO\Categorias;
use MUO\Exposeng;
use MUO\Exposiciones;
use MUO\Museos;
use MUO\MuseosEn;

include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if(isset($userID)){
    protegerAdmin($userID);
}
else{
    header("location: /");
}

$exposiciones = Exposiciones::all();
if(!$exposiciones){
    $exposiciones = [];
}

$msg = $_SESSION["alert"]["message"] ?? '';
$title = $_SESSION["alert"]["title"] ?? '';
$type = $_SESSION["alert"]["type"] ?? '';
$alert = $_SESSION["alert"]["alert"] ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - PANEL EXPO</title>

    <!-- css -->
    <link rel="stylesheet" href="/css/general/general.css">
    <link rel="stylesheet" href="/fonts/font.css">

    <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 480px) and (max-width: 1043px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <link rel="stylesheet" href="/css/adminRead/mobile/style.css" >

</head>
<body data-page="admin-expo" data-item="expo">
    <?php include "../../../includes/templates/headerAdmin.php" ?>

    <?= sendAlert($alert,$msg, $title ,$type)?>


   <div class="center">
        <main class="main">
            <div class="main__container">
                <div class="main__top">
                    <h1 class="main__title" id="title">
                        Exposiciones
                    </h1>

                    <a href="/" class="main__go-back" id="goback">
                        Volver
                    </a>
                </div>


                <div class="main__items">
                    <a href="/admin/items/expo/add.php" class="main__add">
                        <img src="/img/icons/add.svg" alt="Add icon" class="main__add-icon">
                        <p class="main__add-text" id="add">Agregar Exposicion</p>
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
                                    <p class="main__th" id="museo">Museo</p>
                                </th>
                                <th class="main__table-th">
                                    <p class="main__th" id="categoria">Categoria</p>
                                </th>
                                <th class="main__table-th">
                                    <p class="main__th" id="actions">Acciones</p>
                                </th>
                            </tr>
                            <?php foreach($exposiciones as $expo){ ?>
                                <tr class="main__data">
                                    <td class="main__td"><?=$expo->id?></td>
                                    <td class="main__td min-w-name"><?=($_SESSION["lang"]=="es") ? $expo->nombre :  Exposeng::where("id_expo", $expo->id)->nombre?></td>
                                    
                                    <td class="main__td min-w-td"><?=($_SESSION["lang"]=="es") ? $expo->informacion :  Exposeng::where("id_expo", $expo->id)->informacion?></td>
                                    
                                    <td class="main__td min-w-name"><?= Museos::find($expo->id_museos)->nombre ?></td>

                                    <td class="main__td"><?=($_SESSION["lang"] == "es") ? Categorias::find($expo->id_categorias)->nombre : CategoriaEng::where("id_categoria", $expo->id_categorias)->nombre ?></td>
                                    
                                    <td class="main__td">
                                        <div class="main__actions-wrapper">
                                            <a href="/admin/items/expo/edit.php?id=<?=$expo->id?>" class="main__action bc-a">
                                                <img src="/img/icons/edit.svg" class="main__action-icon" alt="">
                                            </a>
                                            <div class="main__action bc-r delete-btn" id="<?=$expo->id?>" onclick="getItem(this)">
                                                <img src="/img/icons/delete.svg" class="main__action-icon" alt="">
                                            </div>
                                            <a href="/admin/items/expo/inspect.php?id=<?=$expo->id?>" class="main__action bc-g" >
                                                <img src="/img/icons/inspect.svg" class="main__action-icon" alt="">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <!-- Datos -->
                            <!-- <tr class="main__data">
                                <td class="main__td" >1</td>
                                <td class="main__td min-w-name">Monumento</td>
                                <td class="main__td min-w-td">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, possimus. Impedit, provident dicta minima nam laboriosam, repellat ratione blanditiis commodi temporibus quia deleniti hic ipsum sunt sint quasi nisi repudiandae autem voluptatum inventore! Accusamus sint ut eligendi consectetur reiciendis eius. Earum magni ratione accusamus optio perspiciatis porro nihil voluptas blanditiis!</td>
                                <td class="main__td min-w-name" >Museo el juan</td>
                                <td class="main__td" >Arte</td>
                                <td class="main__td">
                                    <div class="main__actions-wrapper">
                                        <a href="/admin/items/expo/edit.php" class="main__action bc-a">
                                            <img src="/img/icons/edit.svg" class="main__action-icon" alt="">
                                        </a>
                                        <div class="main__action bc-r delete-btn">
                                            <img src="/img/icons/delete.svg" class="main__action-icon" alt="">
                                        </div>
                                        <a href="/admin/items/expo/inspect.php" class="main__action bc-g">
                                            <img src="/img/icons/inspect.svg" class="main__action-icon" alt="">
                                        </a>
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