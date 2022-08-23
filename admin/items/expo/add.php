<?php

use MUO\CategoriaEng;
use MUO\Museos;
use MUO\Categorias;
use MUO\Exposeng;
use MUO\Exposiciones;
use MUO\Imagenesexpo;

include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if (isset($userID)) {
    protegerAdmin($userID);
} else {
    header("location: /");
}

#Obtener museos
$museos = Museos::all();
if(!$museos){
    $museos = [];
}

#Obtener categorias
$categorias = Categorias::all();
if(!$categorias){
    $categorias = [];
}

#Incializar errores y arreglos
$error = [];
$errorEN = [];

$expo = [];
$expoEN = [];
$imagenes = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){

    #Recoleccion de datos
    $expo["nombre"] = strip_tags($_POST["nombre"]);
    $expo["informacion"] = strip_tags($_POST["descripcion"]);
    $expo["id_museos"] = (is_numeric($_POST["museo-id"])) ? intval($_POST["museo-id"]) : '';
    $expo["id_categorias"] = (is_numeric($_POST["categoria-id"])) ? intval($_POST["categoria-id"]) : '';

    $expoEN["nombre"] = strip_tags($_POST["nombre-en"]);
    $expoEN["informacion"] = strip_tags($_POST["descripcion-en"]);

    $imagenes = $_FILES;

    #Creacion de objetos
    $exposicion = new Exposiciones($expo);
    $exposicionEN = new Exposeng($expoEN);

   
    //Validacion de datos

    #Primera validacion (Español)
    $exposicion->validate();
    $error = Exposiciones::getErrors();





    if (!$error) {
        #Segunda validacion (Ingles)
        $exposicionEN->validate();
        $errorEN = Exposeng::getErrors();

        if (!$errorEN) {

            #Ver si no existe ninguna imagen
            if (!$imagenes) {
                $error["imagen"] = "Debes agregar al menos una imagen !";
                $error["code"] = 28;
            } else {
                #Validar todas las imagenes
                foreach ($imagenes as $foto) {
                    if ($foto["type"] != "image/jpeg" && $foto["type"] != "image/png" && $foto["type"] != "image/gif") {
                        $error["imagen"] = "El archivo debe ser una imagen";
                        $error["code"] = 29;
                    } else if ($foto["size"] > 2 * 1000 * 1000) {
                        $error["imagen"] = "El archivo debe ser menor a 2MB";
                        $error["code"] = 30;
                    }
                }
            }
        }
        
        
        if(!$error && !$errorEN){
            #Guardar datos
            $exposicion->save();
            
            #Identificar exposicion id
            $id = Exposiciones::where("nombre", $exposicion->nombre)->getData("id");
            
            #Determinar la exposicion id
            $exposicionEN->setData("id_expo", $id);
            
            #Guardar registro
            $exposicionEN->save();
            
            #Guardar imagenes
            foreach($imagenes as $foto){
                
                #Crear directorio
                $carpetaExpo = "../../../expoImg";
                if(!is_dir($carpetaExpo)){
                    echo $carpetaExpo;
                    mkdir($carpetaExpo);
                }
                
                $nombreArchivo = md5(uniqid()) . ".jpg";
                
                #Definir ruta del archivo de la imagen
                $rutaArchivo = $carpetaExpo . "/" . $nombreArchivo;
                
                #Guardar ruta de la imagen para la base de datos
                $imagenDb = "/expoImg/" . $nombreArchivo;
                
                #Crear arreglo para la instancia
                $img["rutaImagen"] = $imagenDb;
                $img["id_exposicion"] = $id;
                
                #Crearndo Objeto
                $imageExpo = new Imagenesexpo($img);
                
                
                #Crear ruta del archivo
                mkdir(dirname($rutaArchivo));
                
                #Obtener la imagen desde los temporales
                move_uploaded_file($foto["tmp_name"], $rutaArchivo);
                
                
                #Guardar en la BD
                $imageExpo->save();
                
                //Termina el proceso de la imagen
            }

            
            if($_SESSION["lang"] == "es"){
                $_SESSION["alert"]["message"] = "Exposicion guardada con exito";
                $_SESSION["alert"]["type"] = "success";
                $_SESSION["alert"]["alert"] = "simple";
            }else{
                $_SESSION["alert"]["message"] = "Exhibition saved with success";
                $_SESSION["alert"]["type"] = "success";
                $_SESSION["alert"]["alert"] = "simple";
            }
            header("location: /admin/items/expo");
            
        }
        
        
    }
    debugear($errorEN);
}
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - CREAR</title>



    <!-- css -->
    <link rel="stylesheet" href="/css/general/general.css">
    <link rel="stylesheet" href="/fonts/font.css">

    <!-- css -->
    <link rel="stylesheet" href="/css/headerAdmin/mobile/style.css" media="(max-width: 480px)">
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 480px) and (max-width: 1024px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <link rel="stylesheet" href="/css/adminEdit/mobile/style.css">
    <link rel="stylesheet" href="/css/adminEdit/desktop/style.css" media="(min-width: 1024px)">
    <link rel="stylesheet" href="/css/adminEdit/tablet/style.css" media="(min-width: 630px) and (max-width: 1024px)">
</head>

<body data-page="admin-add-expo">
    <?php include "../../../includes/templates/headerAdmin.php" ?>
    <main class="main">
        <div class="main__wrapper">
            <h1 class="main__title" id="title">Crear Exposicion</h1>


            <form action="add.php" method="POST" class="main__data-container" enctype="multipart/form-data">
                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="data-esp">Datos en español</h3>

                        <div class="main__input-field">
                            <label class="main__label" for="nombre" id="name-expo">Nombre de la exposicion</label>
                            <?php 
                            getError($error, "nombre");
                            ?> 
                            <input type="text" class="main__input <?= getColorError($error, "nombre")?>" id="nombre" name="nombre" placeholder="Nombre de la exposicion" value="<?=restoreFormData($expo, "nombre")?>"> 
                        </div>

                        <div class="main__input-textarea">
                            <label for="descripcion" id="info-expo">Informacion de la exposicion</label>
                            <?php 
                            getError($error, "informacion");
                            ?>
                            <textarea class="main__textarea <?= getColorError($error, "informacion")?>" name="descripcion" id="descripcion" rows="4" placeholder="Informacion de la exposicion"><?=restoreFormData($expo, "informacion")?></textarea>
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
                                    <div class="main__items museum-items <?=restoreSelectItem($expo, "id_museos", $museo->id)?>" id="<?= $museo->id?>">
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
                                    <div class="main__items category-items <?=restoreSelectItem($expo, "id_categorias", $categoria->id)?>" id="<?= $categoria->id?>">
                                        <p><?=($_SESSION["lang"] == 'es') ? $categoria->nombre : CategoriaEng::where("id_categoria", $categoria->id)->nombre ?></p>
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
                            <input type="text" class="main__input <?= getColorError($errorEN, "nombre")?>" id="nombre-en" name="nombre-en" placeholder="Nombre del museo" value="<?=restoreFormData($expoEN, "nombre")?>">
                        </div>

                        <div class="main__input-textarea">
                            <label for="descripcion-en" id="info-expo-en">Informacion de la exposicion</label>
                            <?php 
                            getError($errorEN, "informacion");
                            ?>
                            <textarea class="main__textarea <?= getColorError($errorEN, "informacion")?>" name="descripcion-en" id="descripcion-en" rows="4" placeholder="Informacion de la exposicion"><?=restoreFormData($expoEN, "informacion")?></textarea>
                        </div>

                        <div class="main__input-field main__img-container ">
                            <p id="expo-images">Imagenes</p>
                            <?php  
                            getError($error, "imagen");
                            ?>
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
    <script src="/js/lang.js" type="module"></script>
    <script src="/js/select.js"></script>
    <script src="/js/imgColumnAdd.js"></script>
    <script src="/js/inputError.js"></script>
</body>

</html>