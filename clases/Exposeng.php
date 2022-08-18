<?php  
namespace MUO;

class Exposeng extends ActiveRecord{
    protected static $table = 'exposeng';
    protected static $dbColumn = ['id', 'informacion','nombre', 'id_expo'];

    public $id;
    public $informacion;
    public $nombre;
    public $id_expo;

    public function __construct($arr = [])
    {
        $this->id = $arr["id"] ?? '';
        $this->informacion = $arr["informacion"] ?? '';
        $this->nombre = $arr["nombre"] ?? '';
        $this->id_expo = $arr["id_expo"] ?? '';
    }

    public function validate(){
        if(!$this->nombre){
            self::$errors["nombre"] = "El nombre no puede estar vacio!";
            self::$errors["code"] = 23;
        }
        else if(strlen($this->nombre) > 155){
            self::$errors["nombre"] = "El nombre es muy largo ! Max 120";
            self::$errors["code"] = 26;
        }
        else if(!$this->informacion){
            self::$errors["informacion"] = "La informacion no puede estar vacia !";
            self::$errors["code"] = 24;
        }
        else if(strlen($this->informacion) > 550){
            self::$errors["informacion"] = "La informacion es muy extensa ! Max 550";
            self::$errors["code"] = 25;
        }
    }
}