<?php  
namespace MUO;

class Exposiciones extends ActiveRecord{
    protected static $table = 'exposiciones';
    protected static $dbColumn = ['id', 'nombre', 'informacion', 'id_museos', 'id_categorias'];

    public $id;
    public $nombre;
    public $informacion;
    public $id_museos;
    public $id_categorias;

    public function __construct($arr = [])
    {
        $this->id = $arr["id"] ?? '';
        $this->nombre = $arr["nombre"] ?? '';
        $this->informacion = $arr["informacion"] ?? '';
        $this->id_museos = $arr["id_museos"] ?? '';
        $this->id_categorias = $arr["id_categorias"] ?? '';
    }

    
    public function validate(){
        if(!$this->nombre){
            static::$errors["nombre"] = "El nombre no puede estar vacio!";
            static::$errors["code"] = 23;
        }
        else if(strlen($this->nombre) > 155){
            static::$errors["nombre"] = "El nombre es muy largo ! Max 120";
            static::$errors["code"] = 26;
        }
        else if(!$this->informacion){
            static::$errors["informacion"] = "La informacion no puede estar vacia !";
            static::$errors["code"] = 24;
        }
        else if(strlen($this->informacion) > 255){
            static::$errors["informacion"] = "La informacion es muy extensa ! Max 255";
            static::$errors["code"] = 25;
        }
        else if(!Museos::find($this->id_museos)){
            static::$errors["id_museos"] = "El museo es invalido !";
            static::$errors["code"] = 30;
        }
        else if(!Categorias::find($this->id_categorias)){
            static::$errors["id_categorias"] = "La categoria es invalida !";
            static::$errors["code"] = 31;
        }
    }
}
?>