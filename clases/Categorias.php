<?php

namespace MUO;

class Categorias extends ActiveRecord{
    protected static $table = 'categorias';
    protected static $dbColumn = ['id', 'nombre'];

    public $id;
    public $nombre;

    public function __construct($categoria)
    {
       $this->id = $categoria["id"] ?? '';
       $this->nombre = $categoria["nombre"] ?? ''; 
    }

    public function validar(){
        if(!$this->nombre){
            self::$errors["categoria"] = "El nombre de la categoria esta vacia";
            self::$errors["code"] = 20;
        }

        else if(strlen($this->nombre) > 45){
            self::$errors["categoria"] = "El nombre de la categoria es demaciado largo (Max 45)";
            self::$errors["code"] = 21;
        }

        $categoriaDuplicated = static::where("nombre", $this->nombre);

        if($categoriaDuplicated){
            self::$errors["categoria"] = "Esa categoria ya existe, verifica que no existe otra categoria con el mismo nombre";
            self::$errors["code"] = 22;
        }
        
    }
}