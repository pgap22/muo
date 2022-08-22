<?php

namespace MUO;

class Favoritos extends ActiveRecord{ 
    protected static $table = 'favoritosusuarios';
    protected static $dbColumn = ['id', 'id_exposicion', 'id_usuario'];

    public function __construct($arr = [])
    {
        $this->id = $arr["id"] ?? '';
        $this->id_exposicion = $arr["id_exposicion"] ?? '';
        $this->id_usuario = $arr["id_usuario"] ?? '';
    }
  

    public function validate(){
        $query = self::executeSQL("SELECT * FROM favoritosusuarios WHERE id_usuario = $this->id_usuario AND id_exposicion = $this->id_exposicion");
        $result = self::fetchResultSQL($query);

        if(!Exposiciones::find($this->id_exposicion)){
            self::$errors = true;
        }
        else if(!Usuarios::find($this->id_usuario)){
            self::$errors = true;
        }
        else if($result){
            self::$errors["fav"] = $result;
        }
    }

}