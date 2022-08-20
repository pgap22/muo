<?php

use MUO\Exposeng;
use MUO\Exposiciones;
use MUO\Imagenesexpo;

include "../includes/app.php";

$item = $_GET["item"] ?? '';
$limit = $_GET["limit"] ?? 1;
$page = $_GET["page"] ?? 1;

if($item == 'expo' && $limit && $page){
    #Obtener todas las expo
    $array = Exposiciones::all();

    #Añadirles la info en ingles
    foreach ($array as $key => $value) {
        $array[$key] = (array) $array[$key];
        $array[$key]["info-eng"] = Exposeng::where("id_expo", $array[$key]["id"])->informacion;
        $array[$key]["imagen"] = Imagenesexpo::where("id_exposicion", $array[$key]["id"])->rutaImagen;
    }
    
    $start  =  ($page - 1) * $limit;
    $end = $page  * $limit;

    #Mostrar datos;
    echo json_encode(array_slice($array, $start,$limit ));
}

if($item == "recommend-expo"){
    
}



?>