<?php  

namespace MUO;

class Imagenesexpo extends ActiveRecord{
    protected static $table = 'imagenesexpo';
    protected static $dbColumn = ['id', 'rutaImagen', 'id_exposicion'];

    public $id;
    public $rutaImagen;
    public $id_exposicion;

    public function __construct($arr = [])
    {
        $this->id = $arr["id"] ?? '';
        $this->rutaImagen = $arr["rutaImagen"] ?? '';
        $this->id_exposicion = $arr["id_exposicion"] ?? '';
    }

    public static function validateImg($file){
        if($file["type"] != "image/jpeg" && $file["type"] != "image/png" && $file["type"] != "image/gif"){
            self::$errors["imagen"] = "El archivo debe ser una imagen";
            self::$errors["code"] = 29;
        }
        else if($file["size"] > 2 * 1000 * 1000){
            self::$errors["imagen"] = "El archivo debe ser menor a 2MB";
            self::$errors["code"] = 30;
        }
    }

    public function getNameFile(){
        return explode("/", $this->rutaImagen)[2];
    }

    


}


?>