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



#Detectar si no existe id en la url
if(!isset($_GET["id"])){
    header("location: /admin/items/categorias");
}

$id = $_GET["id"];

#Detectar si el item existe
$categoria = Categorias::find($id);

if(!$categoria){
    if($_SESSION["lang"] == "es"){
        $_SESSION["alert"]["message"] = "No se encontro el item!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }else{
        $_SESSION["alert"]["message"] = "Item was not found!";
        $_SESSION["alert"]["type"] = "warning";
        $_SESSION["alert"]["alert"] = "simple";
    }
    header("location: /admin/items/categorias");
    die();
}
#Buscar la categoria en ingles
$categoriaENG = CategoriaEng::where("id_categoria", $categoria->id);

$error = [];
$errorEN = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
      
    #Recoleccion de datos
    $catg["nombre"] = $_POST["nombre_categoria"];
    $catgEn["nombre"] = $_POST["name_categoria"];


    #Detectar si existieron cambios
    if($categoria->nombre != $catg["nombre"]){
        #Cambiar nombres
        $categoria->setData("nombre", $catg["nombre"]);
        
        #Validar datos
        $categoria->validar();

        #Capturar errores
        $error = Categorias::getErrors();
    }
    
    if($categoriaENG->nombre != $catgEn["nombre"]){
        #Cambiar nombres
        $categoriaENG->setData("nombre", $catgEn["nombre"]);

        #Validar datos
        $categoriaENG->validar();

        $errorEN = CategoriaEng::getErrors();
    }



    if(!$error){

        if(!$errorEN){
            #Guardar cambios
            $categoria->save();
            $categoriaENG->save();
            
            #Enviando Alerta

            if($_SESSION["lang"] == "es"){
                $_SESSION["alert"]["type"] = "success";
                $_SESSION["alert"]["message"] = "Categoria editada con exito";
                $_SESSION["alert"]["alert"] = "simple";
            }
            else{
                $_SESSION["alert"]["type"] = "success";
                $_SESSION["alert"]["message"] = "Category edited with success";
                $_SESSION["alert"]["alert"] = "simple";
            }
            header("location: /admin/items/categorias");
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
    <title>MUO - AGREGAR</title>



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

    <script defer src="/js/inputError.js"></script>
</head>

<body data-page="admin-add-categoria">
    <?php include "../../../includes/templates/headerAdmin.php" ?>
    <main class="main">
        <div class="main__wrapper">
            <h1 class="main__title" id="edit">Editar Categoria</h1>


            <form action="edit.php?id=<?=$id?>" method="POST" class="main__data-container">
                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="data-esp">Datos en español</h3>
                        <div class="main__input-field">
                            <label class="main__label" for="name_categoria" id="name-category">Nombre de la categoria</label>

                            <?php 
                            getError($error, "categoria");
                            ?>

                            <input type="text" class="main__input  <?= getColorError($error, "categoria") ?> " id="nombre_categoria" name="nombre_categoria" placeholder="Nombre del museo" value="<?= $categoria->nombre?>">
                        </div>
                    </div>
                </div>

                <div class="main__data">
                    <div class="main__data-wrapper">
                        <h3 class="main__data-title" id="dato-eng">Datos en Ingles</h3>
                  

                        <div class="main__input-field">
                            <label class="main__label" for="name_categoria" id="name-category">Nombre de la categoria</label>
                            <?php 
                            getError($errorEN, "categoria");
                            ?>
                            <input type="text" class="main__input <?= getColorError($errorEN, "categoria") ?>" id="name_categoria" name="name_categoria" placeholder="Nombre del museo" value="<?= $categoriaENG->nombre?>">
                        </div>
                    </div>
                </div>

                <div class="main__submit main__one-row main__third-column">
                    <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text" id="btn-edit">Editar</span>
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