<?php

use MUO\CategoriaEng;
use MUO\Categorias;

include "../../../includes/app.php";
session_start();
$userID = $_SESSION["user_id"];

if (isset($userID)) {
    protegerAdmin($userID);
} else {
    header("location: /");
}

$catg = [];
$catgEn = [];

#Incializando errores
$error = [];
$errorEN = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    #Recoleccion de datos
    $catg["nombre"] = htmlentities($_POST["nombre_categoria"]);
    $catgEn["nombre"] = htmlentities($_POST["name_categoria"]);

    #Crear el objeto
    $categoria = new Categorias($catg);

    #Validar datos
    $categoria->validar();

    #Capturar errores
    $error = Categorias::getErrors();

    if(!$error){
        #Crer objeto de ingles
        $categoriaENG = new CategoriaEng($catgEn);

        #Validar datos
        $categoriaENG->validar();

        $errorEN = CategoriaEng::getErrors();

        if(!$errorEN){

            #Guardar categoria en español para obtener su id para la de ingles
            $categoria->save();

            #Obtener id
            $id = Categorias::where("nombre", $categoria->nombre)->getData("id");

            #Asignar el id del item recien guardado
            $categoriaENG->setData("id_categoria", $id);
            
            #Guardar el dato en ingles
            $categoriaENG->save();


            if($_SESSION["lang"] == "es"){
                $_SESSION["alert"]["type"] = "success";
                $_SESSION["alert"]["message"] = "Categoria guardada con exito";
                $_SESSION["alert"]["alert"] = "simple";
            }
            else{
                $_SESSION["alert"]["type"] = "success";
                $_SESSION["alert"]["message"] = "Category saved with success";
                $_SESSION["alert"]["alert"] = "simple";
            }
            header("location: /admin/items/categorias");
        }


      
   
    }

}

// function getError($error, $type){
//     if(isset($error[$type])){
//         $errorCode = $error["code"];
//         echo "<p class='errorMessage error' id='$errorCode-e'>$error[$type]</p>";
//     }
// }

// function getColorError($error, $type){
//     if(isset($error[$type])){
//         return "errorBorder";
//     }
//     return "";
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - AGREGAR</title>



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

<body data-page="admin-add-categoria">
    <?php include "../../../includes/templates/headerAdmin.php" ?>
    <main class="main">
        <div class="main__wrapper">
            <h1 class="main__title" id="title">Agregar Categoria</h1>


            <form action="add.php" method="POST" class="main__data-container">
                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="data-esp">Datos en español</h3>
                        <div class="main__input-field">
                            <label class="main__label" for="name_categoria" id="name-category">Nombre de la categoria</label>

                            <?php 
                            getError($error, "categoria");
                            ?>

                            <input type="text" class="main__input  <?= getColorError($error, "categoria") ?> " id="nombre_categoria" name="nombre_categoria" placeholder="Nombre de la categoria" value="<?= restoreFormData($catg, "nombre")?>">
                        </div>
                    </div>
                </div>

                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="dato-eng">Datos en Ingles</h3>
                        <div class="main__input-field">
                            <label class="main__label" for="name_categoria" id="name-category-en">Nombre de la categoria</label>
                            
                            <?php 
                            getError($errorEN, "categoria");
                            ?>

                            <input value="<?= restoreFormData($catgEn, "nombre")?>" type="text" class="main__input <?= getColorError($errorEN, "categoria") ?>" id="name_categoria" name="name_categoria" placeholder="Nombre de la categoria">
                        </div>
                    </div>
                </div>

                <div class="main__submit main__one-row main__third-column">
                    <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text" id="btn-send">Agregar</span>
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