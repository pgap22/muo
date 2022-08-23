<?php

use MUO\CategoriaEng;
use MUO\Categorias;

include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if(isset($userID)){
    protegerAdmin($userID);
}
else{
    header("location: /");
}

$msg = $_SESSION["alert"]["message"] ?? '';
$title = $_SESSION["alert"]["title"] ?? '';
$type = $_SESSION["alert"]["type"] ?? '';
$alert = $_SESSION["alert"]["alert"] ?? '';

#Obtener todas la categorias
$categorias = Categorias::all();
if(!$categorias){
    $categorias = [];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - PANEL CATEGORIAS</title>

    <!-- css -->
    <link rel="stylesheet" href="/css/general/general.css">
    <link rel="stylesheet" href="/fonts/font.css">

    <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 480px) and (max-width: 1024px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <link rel="stylesheet" href="/css/adminRead/mobile/style.css" >

</head>
<body data-page="admin-categoria" data-item="categorias">

    <?php include "../../../includes/templates/headerAdmin.php" ?>

    <?= sendAlert($alert,$msg, $title ,$type)?>
    
    
    <div class="center">
        <main class="main">
            <div class="main__container">
                <div class="main__top">
                    <h1 class="main__title" id="title">
                        Categorias
                    </h1>
                    
                    <a href="/" class="main__go-back" id="goback">
                        Volver
                    </a>
                </div>
                
                
                <div class="main__items">
                    <a href="/admin/items/categorias/add.php" class="main__add">
                        <img src="/img/icons/add.svg" alt="Add icon" class="main__add-icon">
                        <p class="main__add-text" id="add">Agregar Categoria</p>
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
                                    <p class="main__th" id="actions">Acciones</p>
                                </th>
                            </tr>

                            <?php foreach($categorias as $categoria){  ?>
                                <tr class="main__data">
                                    <td class="main__td"><?= $categoria->id ?></td>
                                    <td class="main__td min-w-name"><?=($_SESSION["lang"] == "es") ? $categoria->nombre : CategoriaEng::where('id_categoria', $categoria->id)->nombre ?></td>
                                    <td class="main__td">
                                        <div class="main__actions-wrapper two-action">
                                            <a href="/admin/items/categorias/edit.php?id=<?=$categoria->id?>" class="main__action bc-a">
                                                <img src="/img/icons/edit.svg" class="main__action-icon" alt="">
                                            </a>
                                            <div class="main__action bc-r delete-btn" id=<?=$categoria->id?> onclick="getItem(this)">
                                                <img src="/img/icons/delete.svg" class="main__action-icon" alt="">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php }  ?>
                            <!-- Datos -->
                            <!-- <tr class="main__data">
                                <td class="main__td" >1</td>
                                <td class="main__td min-w-name">Arte</td>
                                <td class="main__td">
                                    <div class="main__actions-wrapper two-action">
                                        <a href="/admin/items/categorias/edit.php" class="main__action bc-a">
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