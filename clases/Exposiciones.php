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
        else if(!Museos::find($this->id_museos)){
            self::$errors["id_museos"] = "El museo es invalido !";
            self::$errors["code"] = 40;
        }
        else if(!Categorias::find($this->id_categorias)){
            self::$errors["id_categorias"] = "La categoria es invalida !";
            self::$errors["code"] = 41;
        }
    }
}
?>