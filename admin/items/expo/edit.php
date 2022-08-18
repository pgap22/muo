<?php

use MUO\CategoriaEng;
use MUO\Museos;
use MUO\Categorias;
use MUO\Exposeng;
use MUO\Exposiciones;
use MUO\Imagenesexpo;
use MUO\Util;

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
    header("location: /admin/items/expo");
}

$id = $_GET["id"];

#Detectar si el item existe
$exposicion = Exposiciones::find($id);

#Contador de imagenes
$i = 0;

if (!$exposicion) {


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
    die();
}

#Obtener item imagenes
$expoImagenes = Imagenesexpo::where("id_exposicion", $exposicion->id, 0);

#Obtener item en ingles
$exposicionEN = Exposeng::where("id_expo", $exposicion->id);

#Arreglo para los select
$select["id_museos"] = $exposicion->id_museos;
$select["id_categorias"] = $exposicion->id_categorias;

#Obtener museos
$museos = Museos::all();
if (!$museos) {
    $museos = [];
}

#Obtener categorias
$categorias = Categorias::all();
if (!$categorias) {
    $categorias = [];
}

#Incializar errores y arreglos
$error = [];
$errorEN = [];

$expo = [];
$expoEN = [];
$imagenesViejas = [];
$newImagenes = [];
$oldImg = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    #Recoleccion de datos
    $expo["nombre"] = htmlentities($_POST["nombre"]);
    $expo["informacion"] = htmlentities($_POST["descripcion"]);
    $expo["id_museos"] = (is_numeric($_POST["museo-id"])) ? intval($_POST["museo-id"]) : '';
    $expo["id_categorias"] = (is_numeric($_POST["categoria-id"])) ? intval($_POST["categoria-id"]) : '';

    $expoEN["nombre"] = htmlentities($_POST["nombre-en"]);
    $expoEN["informacion"] = htmlentities($_POST["descripcion-en"]);

    $newImagenes = $_FILES;

    #Obtener las imagenes viejas
    foreach ($_POST as $value => $data) {
        if (str_starts_with($value, "img-")) {
            $imagenesViejas[] = $data;
        }
    }



    #Crear nueva instancia para obtener cambios
    $expoChanges = new Exposiciones($expo);
    $expoChangeEn = new Exposeng($expoEN);

    #Detectar cambios
    foreach ($expoChanges as $expoChange => $value) {
        if ($expoChange == "id") continue;

        if ($exposicion->$expoChange != $value) {
            $exposicion->setData($expoChange, $value);
        }
    }


    #Detectar cambios
    foreach ($expoChangeEn as $expoChange => $value) {
        if ($expoChange == "id" || $expoChange == "id_expo") continue;

        if ($exposicionEN->$expoChange != $value) {
            $exposicionEN->setData($expoChange, $value);
        }
    }


    #Validar si hay nuevas fotos
    if ($newImagenes) {
        foreach ($newImagenes as $imagen) {
            Imagenesexpo::validateImg($imagen);
        }
        $error = Imagenesexpo::getErrors();
    }

    if (!$imagenesViejas) {
        $error["imagen"] = "Debes agregar al menos una imagen !";
        $error["code"] = 28;
    }

    #Validacion de datos nuevos
    $exposicion->validate();
    $error = Exposiciones::getErrors();
    if (!$error) {
        $exposicionEN->validate();
        $errorEN = Exposeng::getErrors();
        if (!$errorEN) {
            #Guardar Datos
            if (!$error && !$errorEN && $imagenesViejas) {

                #Agregar nuevas imagenes
                foreach ($newImagenes as $foto) {

                    #Crear directorio
                    $carpetaExpo = "../../../expoImg";
                    if (!is_dir($carpetaExpo)) {
                        mkdir($carpetaExpo);
                    }

                    $nombreArchivo = md5(uniqid()) . ".jpg";

                    #Definir ruta del archivo de la imagen
                    $rutaArchivo = $carpetaExpo . "/" . $nombreArchivo;

                    #Guardar ruta de la imagen para la base de datos
                    $imagenDb = "/expoImg/" . $nombreArchivo;

                    #Crear arreglo para la instancia
                    $img["rutaImagen"] = $imagenDb;
                    $img["id_exposicion"] = $exposicion->getData("id");

                    #Crearndo Objeto
                    $imageExpo = new Imagenesexpo($img);


                    #Obtener la imagen desde los temporales
                    move_uploaded_file($foto["tmp_name"], $rutaArchivo);


                    #Guardar en la BD
                    $imageExpo->save();

                    //Termina el proceso de la imagen
                }

                #Obtener que imagenes se borraron y borrarlas
                foreach ($expoImagenes as $i => $img) {

                    #Verificar si no existe la imagen pero en la bd si, y esi es asi borrarla

                    if (!Util::is_in_array($img->getNameFile(), $imagenesViejas)) {
                        #Ruta de la imagen
                        $rutaImagen = "../../.." . $img->rutaImagen;

                        #Eliminar Imagen
                        if (is_file($rutaImagen)) {
                            unlink($rutaImagen);
                        }

                        #Borrarlo de la base de datos
                        $img->delete();
                    }
                }

                #Verificar si hay alamenos una imagen
                if (!Imagenesexpo::where("id_exposicion", $exposicion->id, 0)) {
                    $error["imagen"] = "Debes agregar al menos una imagen !";
                    $error["code"] = 28;
                }


                #Si no hay errores guardar
                if (!$error) {
                    #Guardar los registros
                    $exposicion->save();
                    $exposicionEN->save();

                    #Alerta

                    if($_SESSION["lang"] == "es"){
                        $_SESSION["alert"]["type"] = "success";
                        $_SESSION["alert"]["message"] = "Exposicion editada con exito";
                        $_SESSION["alert"]["alert"] = "simple";
                    }else{
                        $_SESSION["alert"]["type"] = "success";
                        $_SESSION["alert"]["message"] = "Exhibition edited with success";
                        $_SESSION["alert"]["alert"] = "simple";
                    }
                    header("location: /admin/items/expo");
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - Editar</title>



    <!-- css -->
    <link rel="stylesheet" href="/css/general/general.css">
    <link rel="stylesheet" href="/fonts/font.css">

    <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 481px) and (max-width: 1023px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <link rel="stylesheet" href="/css/adminEdit/mobile/style.css">
    <link rel="stylesheet" href="/css/adminEdit/desktop/style.css" media="(min-width: 1024px)">
    <link rel="stylesheet" href="/css/adminEdit/tablet/style.css" media="(min-width: 630px) and (max-width: 1023px)">
</head>

<body data-page="admin-add-expo">
    <?php include "../../../includes/templates/headerAdmin.php" ?>
    <main class="main">
        <div class="main__wrapper">
            <h1 class="main__title" id="edit">Editar Exposicion</h1>


            <form action="edit.php?id=<?=$exposicion->id?>" method="POST" class="main__data-container" enctype="multipart/form-data">
                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="data-esp">Datos en español</h3>

                        <div class="main__input-field">
                            <label class="main__label" for="nombre" id="name-expo">Nombre de la exposicion</label>
                            <?php 
                            getError($error, "nombre");
                            ?> 
                            <input type="text" class="main__input <?= getColorError($error, "nombre")?>" id="nombre" name="nombre" placeholder="Nombre del museo" value="<?=$exposicion->nombre?>"> 
                        </div>

                        <div class="main__input-textarea">
                            <label for="descripcion" id="info-expo">Informacion de la exposicion</label>
                            <?php 
                            getError($error, "informacion");
                            ?>
                            <textarea class="main__textarea <?= getColorError($error, "informacion")?>" name="descripcion" id="descripcion" rows="4" placeholder="Descripcion del museo"><?=$exposicion->informacion?></textarea>
                        </div>

                        <div class="main__input-field">
                            <label for="id_museo" id="expo-museo">Museo</label>
                            <?php 
                            getError($error, "id_museos");
                            ?>
                            <div class="main__select select-museum <?= getColorError($error, "id_museos")?>">
                                <div class="main__selected-item">
                                    <div class="main__selected-text">
                                        <p class="main__placeholder-selected placeholder-museum" id="choose-museo">Selecciona un museo</p>
                                        <p class="main__selected-museum main__selected--primary"></p>
                                    </div>
                                    <img class="main__expand" src="/img/icons/expand_more.svg" alt="">
                                </div>
                            </div>
                            <div class="main__options-items none options-museum">

                                <?php foreach($museos as $museo){ ?>
                                    <div class="main__items museum-items <?=restoreSelectItem($select, "id_museos", $museo->id)?>" id="<?= $museo->id?>">
                                        <p><?=$museo->nombre?></p>
                                    </div>
                                <?php } ?>

                                <input type="number" hidden name="museo-id" id="select-id-museum">
                            </div>
                        </div>

                        <div class="main__input-field">
                            <label for="id_category" id="expo-categoria">Categoria</label>
                            <?php 
                            getError($error, "id_categorias");
                            ?>
                            <div class="main__select select-category <?= getColorError($error, "id_categorias")?>">
                                <div class="main__selected-item">
                                    <div class="main__selected-text">
                                        <p class="main__placeholder-selected placeholder-category" id="choose-categoria">Selecciona una categoria</p>
                                        <p class="main__selected-category main__selected--primary"></p>
                                    </div>
                                    <img class="main__expand" src="/img/icons/expand_more.svg" alt="">
                                </div>
                            </div>

                            <div class="main__options-items none options-category">

                                <?php foreach($categorias as $categoria){ ?>
                                    <div class="main__items category-items <?=restoreSelectItem($select, "id_categorias", $categoria->id)?>" id="<?= $categoria->id?>">
                                        <p><?=($_SESSION["lang"] == 'es') ? $categoria->nombre :  CategoriaEng::where("id_categoria", $categoria->id)->nombre ?></p>
                                    </div>
                                <?php } ?>

                                <input type="number" hidden name="categoria-id" id="select-id-category">
                            </div>
                        </div>

                        <h3 class="main__data-title" id="data-eng">Datos en Ingles</h3>

                        <div class="main__input-field">
                            <label class="main__label" for="nombre-en" id="name-expo-en">Nombre de la exposicion</label>
                            <?php 
                            getError($errorEN, "nombre");
                            ?>
                            <input type="text" class="main__input <?= getColorError($errorEN, "nombre")?>" id="nombre-en" name="nombre-en" placeholder="Nombre del museo" value="<?=$exposicionEN->nombre?>">
                        </div>

                        <div class="main__input-textarea">
                            <label for="descripcion-en" id="name-expo-en">Informacion de la exposicion</label>
                            <?php 
                            getError($errorEN, "informacion");
                            ?>
                            <textarea class="main__textarea <?= getColorError($errorEN, "informacion")?>" name="descripcion-en" id="descripcion-en" rows="4" placeholder="Descripcion del museo"><?=$exposicionEN->informacion?></textarea>
                        </div>

                        <div class="main__input-field main__img-container ">
                            <p id="expo-images">Imagenes</p>
                            <?php  
                            getError($error, "imagen");
                            ?>
                            <div class="main__column-image <?= getColorError($error, "imagen")?>">
                                <label for="img-expo" class="main__img-wrapper ">
                                        <div class="main__img main__img--add <?= getColorError($error, "imagen")?>">
                                            <img src="/img/icons/add.svg" alt="" class="main__add-icon">
                                        </div>
                                </label>
                                
                                <?php for ($i=0; $i < count($expoImagenes) ; $i++) { ?>
                                    <div class="main__img-wrapper ">
                                            <img src="<?=$expoImagenes[$i]->rutaImagen?>" alt="" class="main__img main__img-expo">
                                            <div class="main__img-quit undrag" onclick="quitImage(this)">
                                                <img src="/img/icons/cancel.svg" alt="" class="quit-icon">
                                            </div>
                                            <input type="text" name="img-<?=$i?>" value="<?=explode("/", $expoImagenes[$i]->rutaImagen)[2]?>"  hidden >
                                        </div>
                                <?php } ?>
                                  
                             

                            </div>
                            
                            
                            <template id="img-column">
                                <div class="main__column-image <?= getColorError($error, "imagen")?>">
                                </div>
                            </template>
                            
                            <template id="img-set-expo">
                                <div class="main__img-wrapper ">
                                    <img src="" alt="" class="main__img main__img-expo">
                                    <div class="main__img-quit undrag" onclick="quitImage(this)">
                                        <img src="/img/icons/cancel.svg" alt="" class="quit-icon">
                                    </div>
                                    <input type="file" name="img-" id="img-" hidden accept="image/png, image/gif, image/jpeg" >
                                </div>
                            </template>
                            
                            <template id="add-img-expo">
                                <label for="img-expo" class="main__img-wrapper ">
                                    <div class="main__img main__img--add <?= getColorError($error, "imagen")?>">
                                        <img src="/img/icons/add.svg" alt="" class="main__add-icon">
                                    </div>
                                </label>
                            </template>
                            
                            <input type="file" id="img-expo" hidden accept="image/png, image/gif, image/jpeg" >
                        </div>
                    </div>
                </div>


                <div class="main__submit main__one-row main__third-column">
                    <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text" id="btn-send">Enviar</span>
                        <span class="verification__decoration"></span>
                    </button>
                    <a href="./index.php" class="main__go-back" id="volver">Volver</a>
                </div>
            </form>
        </div>
        </div>
    </main>
    <!-- js -->
    <script src="/js/select.js"></script>
    <script src="/js/imgColumnAdd.js"></script>
    <script src="/js/inputError.js"></script>
    <script src="/js/lang.js" type="module"></script>
</body>

</html>