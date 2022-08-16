<?php 
namespace MUO;

class MuseosEn extends ActiveRecord{
    protected static $table = 'museoseng';
    protected static $dbColumn = ['id', "descripcion", "id_museo"];

    public $id;
    public $descripcion;
    public $id_museo;

    public function __construct($arr = [])
    {
        $this->id = $arr["id"] ?? '';
        $this->descripcion = $arr["descripcion"] ?? '';
        $this->id_museo = $arr["id_museo"] ?? '';
    }

    public function validate(){
       
        if(!$this->descripcion){
            static::$errors["descripcion"] = "La descripcion no puede estar vacia !";
            static::$errors["code"] = 24;
        }

        else if(strlen($this->descripcion) > 255){
            static::$errors["descripcion"] = "La descripcion es muy extensa !";
            static::$errors["code"] = 25;
        }
        
    }


}
?>