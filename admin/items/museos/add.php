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

$museoData = [];
$museoDataEn = [];

#Incializar errores
$error = [];
$errorEN = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    #Recoleccion de datos
    $archivo = $_FILES["new_img"];

    $museoData["nombre"] = htmlentities($_POST["nombre"]);
    $museoData["descripcion"] = htmlentities($_POST["descripcion"]);

    $museoDataEn["descripcion"] = htmlentities($_POST["descripcion-en"]);

    #Crear instancia de museo
    $museo = new Museos($museoData);
    $museoEn = new MuseosEn($museoDataEn);

    #Validacion del archivo
    if(!$archivo["name"]){
        $error["imagen"] = "Debes agregar una imagen";
        $error["code"] = 28;
    }
    else if($archivo["type"] != "image/jpeg" && $archivo["type"] != "image/png" && $archivo["type"] != "image/gif"){
        echo $archivo["type"];
        $error["imagen"] = "El archivo debe ser una imagen";
        $error["code"] = 29;
    }
    else if($archivo["size"] > 2 * 1000 * 1000){
        $error["imagen"] = "El archivo debe ser menor a 2MB";
        $error["code"] = 30;
    }


    #Primer verificacion (Archivo)
    if(!$error){
        #Segunda validacion (Informacion español)
        $museo->validate();
        $error = Museos::getErrors();
        #Tercera validacion (Informacion ingles)
        if(!$error){
            $museoEn->validate();
            $errorEN = MuseosEn::getErrors();


            if(!$errorEN){
                #Crear directorio
                $carpetaMuseos = "../../../museosImg";
                if(!is_dir($carpetaMuseos)){
                    mkdir($carpetaMuseos);
                }

                $nombreArchivo = md5(uniqid()) . ".jpg";

                #Definir ruta del archivo de la imagen
                $rutaArchivo = $carpetaMuseos . "/" . $nombreArchivo;

                

                #Crear ruta del archivo
                mkdir(dirname($rutaArchivo));

                #Obtener la imagen desde los temporales
                move_uploaded_file($archivo["tmp_name"], $rutaArchivo);

                #Guardar ruta de la imagen para la base de datos
                $imagenDb = "/museosImg/" . $nombreArchivo;

                #Guardar en memoria la ruta de la imagen
                $museo->setData("imagen", $imagenDb);
    
                //Termina el proceso de la imagen


                #Guardar Museo en la base de datos
                $museo->save();

                #Obtener id
                $id = Museos::where("nombre", $museo->nombre)->getData("id");

                #Asignar el id foraneo
                $museoEn->setData("id_museo", $id);
                
                #Guardar Datos en ingles
                $museoEn->save();
            }
            


           

            $_SESSION["alert"]["type"] = "success";
            $_SESSION["alert"]["message"] = "Museo guardada con exito";
            $_SESSION["alert"]["alert"] = "simple";
            header("location: /admin/items/museos");
        }
    }
}
debugear($error);
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
    <link rel="stylesheet" href="/css/headerAdmin/tablet/style.css" media="(min-width: 481px) and (max-width: 1023px)">
    <link rel="stylesheet" href="/css/headerAdmin/desktop/style.css" media="(min-width: 1024px)">

    <link rel="stylesheet" href="/css/adminEdit/mobile/style.css">
    <link rel="stylesheet" href="/css/adminEdit/desktop/style.css" media="(min-width: 1024px)">
    <link rel="stylesheet" href="/css/adminEdit/tablet/style.css" media="(min-width: 630px) and (max-width: 1023px)">

    <script defer src="/js/inputError.js"></script>
</head>

<body>
    <?php include "../../../includes/templates/headerAdmin.php" ?>
    <main class="main">
        <div class="main__wrapper">
            <h1 class="main__title">Crear Museo</h1>


            <form action="" method="POST" class="main__data-container" enctype="multipart/form-data">
                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title">Datos en español</h3>
                        <div class="main__input-field">
                            <label class="main__label" for="nombre">Nombre del museo</label>
                            <?php  
                            getError($error, "nombre");
                            ?>
                            <input type="text" class="main__input <?= getColorError($error, "nombre") ?>" id="nombre" name="nombre" placeholder="Nombre del museo" value="<?=restoreFormData($museoData, "nombre") ?>" > 
                        </div>

                        <div class="main__input-textarea">
                            <label for="descripcion">Descripcion del museo</label>
                            
                            <?php  
                            getError($error, "descripcion");
                            ?>

                            <textarea class="main__textarea <?= getColorError($error, "descripcion") ?>" name="descripcion" id="descripcion" rows="4" placeholder="Descripcion del museo"><?=restoreFormData($museoData, "descripcion") ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="main__data">
                   <div class="main__data-wrapper">
                        <h3 class="main__data-title">Datos en ingles</h3>
                            <div class="main__input-textarea">
                                <label for="descripcion-en">Descripcion del museo (ingles)</label>
                                <?php  
                                getError($errorEN, "descripcion");
                                ?>
                                <textarea class="main__textarea <?= getColorError($errorEN, "descripcion") ?>" name="descripcion-en" id="descripcion-en" rows="4" placeholder="Descripcion del museo"><?=restoreFormData($museoDataEn, "descripcion") ?></textarea>
                            </div>
                   </div>
                </div>

                <div class="main__data main__data--center">
                    <h3 class="main__data-title main__data-title--center">Colocar Imagen</h3>
                    <?php  
                    getError($error, "imagen");
                    ?>
                    
                    <label for="new_img" class="main__drag-zone img-upload <?= getColorError($error, "imagen") ?>">
                        <img class="main__preview-img" src="" id="preview-img">
                        <div class="main__drag-text">
                                <p>Arrastra la imagen</p>
                                <p>o</p>
                                <p>haz click</p>
                        </div>
                    </label>
                    <input type="file" hidden name="new_img" id="new_img">
                </div>

                <div class="main__submit main__one-row main__third-column">
                    <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text" id="btn-send">Enviar</span>
                        <span class="verification__decoration"></span>
                    </button>
                    <a href="./index.php" class="main__go-back">Volver</a>
                </div>
            </form>
        </div>
        </div>
    </main>
    
</body>

</html>