<?php 

namespace MUO;

class Museos extends ActiveRecord{
    protected static $table = 'museos';
    protected static $dbColumn = ['id', 'nombre', "descripcion", "imagen"];

    public $id;
    public $nombre;
    public $descripcion;

    public function __construct($mus = [])
    {
        $this->id = $mus["id"] ?? '';
        $this->nombre = $mus["nombre"] ?? '';
        $this->descripcion = $mus["descripcion"] ?? '';
        $this->imagen = $mus["imagen"] ?? '';
    }

    public function validate(){
        if(!$this->nombre){
            static::$errors["nombre"] = "El nombre no puede estar vacio!";
            static::$errors["code"] = 23;
        }
        else if(!$this->descripcion){
            static::$errors["descripcion"] = "La descripcion no puede estar vacia !";
            static::$errors["code"] = 24;
        }
        else if(strlen($this->descripcion) > 500){
            static::$errors["descripcion"] = "La descripcion es muy extensa ! Max 500";
            static::$errors["code"] = 25;
        }
        else if(strlen($this->nombre) > 155){
            static::$errors["nombre"] = "El nombre es muy largo ! Max 155";
            static::$errors["code"] = 26;
        }
        
        
    }
}
?>