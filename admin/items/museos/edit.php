<?php

use MUO\CategoriaEng;
use MUO\Categorias;
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

#Detectar si no existe id en la url
if(!isset($_GET["id"])){
    header("location: /admin/items/museos");
}

$id = $_GET["id"];

#Detectar si el item existe
$museo = Museos::find($id);


if(!$museo){
    
    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "No se encontro el item!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }else{
        $_SESSION["alert"]["message"] = "Item was not found!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }
    header("location: /admin/items/museos");
    die();
}

#Obtener sus datos en ingles
$museoEn = MuseosEn::where("id_museo", $museo->id);



$museoData = [];
$museoDataEn = [];

#Incializar errores
$error = [];
$errorEN = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    #Recoleccion de datos
    $archivo = $_FILES["new_img"];

    $museoData["nombre"] = strip_tags($_POST["nombre"]);
    $museoData["descripcion"] = strip_tags($_POST["descripcion"]);

    $museoDataEn["descripcion"] = strip_tags($_POST["descripcion-en"]);

    #Detectar si existieron cambios
    if($museo->nombre != $museoData["nombre"]){
        #Cambiar datos
        $museo->setData("nombre", $museoData["nombre"]);

        #validacion (Informacion español)
        $museo->validate();

        $error = Museos::getErrors();
    }

    if($museo->descripcion != $museoData["descripcion"]){
        #Cambiar datos
        $museo->setData("descripcion", $museoData["descripcion"]);

        #validacion (Informacion español)
        $museo->validate();

        $error = Museos::getErrors();
    }

    if($museoEn->descripcion != $museoDataEn["descripcion"]){
        $museoEn->setData("descripcion", $museoDataEn["descripcion"]);

        #validacion (Informacion español)
        $museoEn->validate();
        
        $errorEN = Museos::getErrors();
   }

    if($archivo["name"]){
        #Validacion del archivo 
        if($archivo["type"] != "image/jpeg" && $archivo["type"] != "image/png" && $archivo["type"] != "image/gif"){
            echo $archivo["type"];
            $error["imagen"] = "El archivo debe ser una imagen";
            $error["code"] = 29;
        }
        else if($archivo["size"] > 2 * 1000 * 1000){
            $error["imagen"] = "El archivo debe ser menor a 2MB";
            $error["code"] = 30;
        }
        else if($archivo["size"] > 2 * 1000 * 1000){
            $error["imagen"] = "El archivo debe ser menor a 2MB";
            $error["code"] = 31;
        }
    }


    if(!$error && !$errorEN){
        #Si hay imagen solo sobreescribir
        if($archivo["name"]){
            #Ruta del archivo
            $rutaArchivo = "../../../" . $museo->imagen;


            #Obtener la imagen desde los temporales
            move_uploaded_file($archivo["tmp_name"], $rutaArchivo);

        }


        #Guardar Museo en la base de datos
        $museo->save();

        $museoEn->save();
        #Enviando Alerta

        if($_SESSION["lang"] == "es"){
            $_SESSION["alert"]["type"] = "success";
            $_SESSION["alert"]["message"] = "Museo editada con exito";
            $_SESSION["alert"]["alert"] = "simple";
        }
        else{
            $_SESSION["alert"]["type"] = "success";
            $_SESSION["alert"]["message"] = "Museum edited with success";
            $_SESSION["alert"]["alert"] = "simple";
        }
        header("location: /admin/items/museos");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - EDITAR</title>

    <!-- js -->
    <script defer src="/js/imagePreview.js"></script>

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

<body data-page="admin-edit-museo">
    <?php include "../../../includes/templates/headerAdmin.php" ?>
    <main class="main">
        <div class="main__wrapper">
            <h1 class="main__title" id="edit">Editar Museo</h1>


            <form action="" method="POST" class="main__data-container" enctype="multipart/form-data">
                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="datos">Datos en español</h3>
                        <div class="main__input-field">
                            <label class="main__label" for="nombre" id="nombre-museo">Nombre del museo</label>
                            <?php  
                            getError($error, "nombre");
                            ?> 
                            <input type="text" class="main__input <?=getColorError($error, "nombre") ?>" id="nombre" name="nombre" placeholder="Nombre del museo" value="<?=$museo->nombre ?>">
                        </div>

                        <div class="main__input-textarea">
                            <label for="descripcion" id="descripcion-museo">Descripcion del museo</label>
                            <?php  
                            getError($error, "descripcion");
                            ?>
                            <textarea class="main__textarea <?=getColorError($error, "descripcion") ?>" name="descripcion" id="descripcion" rows="4" placeholder="Descripcion del museo" ><?=$museo->descripcion ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="main__data">
                   <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="dato-ingles">Datos en ingles</h3>
                            <div class="main__input-textarea">
                                <label for="descripcion-en" id="descripcion-ingles">Descripcion del museo (ingles)</label>
                                <?php  
                                getError($errorEN, "descripcion");
                                ?>
                                <textarea class="main__textarea <?=getColorError($errorEN, "descripcion") ?>" name="descripcion-en" id="descripcion-en" rows="4" placeholder="Descripcion del museo" ><?=$museoEn->descripcion ?></textarea>
                            </div>
                   </div>
                </div>

                <div class="main__data main__data--center">
                    <h3 class="main__data-title main__data-title--center" id="imagen-edit">Remplazar Imagen</h3>
                    <?php  
                    getError($error, "imagen");
                    ?>
                    <label for="new_img" class="main__drag-zone img-upload">
                        <img class="main__preview-img" src="<?=$museo->imagen ?>" id="preview-img">
                        <div class="main__drag-text none">
                                <p id="p-1">Arrastra la imagen</p>
                                <p id="p-2">o</p>
                                <p id="p-3">haz click</p>
                        </div>
                    </label>
                    <input type="file" hidden name="new_img" id="new_img">
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
    <script src="/js/lang.js" type="module"></script>
</body>

</html>