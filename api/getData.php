<?php
session_start();
use MUO\Exposeng;
use MUO\Exposiciones;
use MUO\Favoritos;
use MUO\Imagenesexpo;
use MUO\Museos;
use MUO\MuseosEn;

include "../includes/app.php";

$item = $_GET["item"] ?? '';
$limit = $_GET["limit"] ?? 1;
$page = $_GET["page"] ?? 1;
$id_expo = $_GET["id_expo"] ?? '';
$museoid = $_GET["museoid"] ?? '';
$id_usuario = $_SESSION["user_id"] ?? '';

if($item == 'expo' && $limit && $page){
    #Obtener todas las expo
    $exposiciones = Exposiciones::all();

    foreach ($exposiciones as $expo) {
        #Añadirles la info en ingles y enviar el array de objetos
        $expo->setData("info_eng", Exposeng::where("id_expo", $expo->id)->informacion);
        $expo->setData("name_eng", Exposeng::where("id_expo", $expo->id)->nombre);

        #Detectar si el usuario lo añadio en favoritos
        $isFav = Favoritos::executeSQL("SELECT * FROM favoritosusuarios WHERE id_usuario = $id_usuario AND id_exposicion = $expo->id");
        $isFav = Favoritos::fetchResultSQL($isFav);

        if($isFav){
            $isFav = true;
        }
        else{
            $isFav = false;
        }

        #Añadirle mas campos
        $expo->setData("isFav", $isFav);
        $expo->setData("imagen", Imagenesexpo::where("id_exposicion", $expo->id)->rutaImagen);
        $array[] = $expo;
    }
    
    $start  =  ($page - 1) * $limit;
    $end = $page  * $limit;

    #Mostrar datos;
    echo json_encode(array_slice($array, $start,$limit ));
}

if($id_expo){
    $expo = Exposiciones::find($id_expo);
    if($expo){
        $expo->setData("info_eng", Exposeng::where("id_expo", $expo->id)->informacion);
        $expo->setData("name_eng", Exposeng::where("id_expo", $expo->id)->nombre);
    }

    echo json_encode($expo);
}

if($museoid){
    $array = Museos::find($museoid);

    if($array){        
        $array->setData("info_en", MuseosEn::where("id_museo", $array->id)->descripcion);
    }

    echo json_encode($array);
}

if(isset($_GET["recommend-expo"])){
    $exposiciones = Exposiciones::getRecommend();
    $array = [];
    if($exposiciones){
        foreach ($exposiciones as $expo) {
            #Añadirles la info en ingles y enviar el array de objetos
            $expo->setData("info_eng", Exposeng::where("id_expo", $expo->id)->informacion);
            $expo->setData("name_eng", Exposeng::where("id_expo", $expo->id)->nombre);
            $expo->setData("imagen", Imagenesexpo::where("id_exposicion", $expo->id)->rutaImagen);
            $array[] = $expo;
        }
    }

    echo json_encode($array);
}

?>