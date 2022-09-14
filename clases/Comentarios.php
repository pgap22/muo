<?php  

namespace MUO;

class Comentarios extends ActiveRecord{
    protected static $table = 'comentarios';
    protected static $dbColumn = ['id', 'contenido', 'id_exposicion', 'id_usuario'];

    public $id;
    public $contenido;
    public $id_exposicion;
    public $id_usuario;

    public function __construct($arr = [])
    {
        $this->id = $arr["id"] ?? '';
        $this->contenido = str_replace("\r\n","",$arr["contenido"] )?? '';
        $this->id_exposicion = $arr["id_exposicion"] ?? '';
        $this->id_usuario = $arr["id_usuario"] ?? '';
    }

    public function validate(){
        if(!$this->contenido){
            self::$errors = createAlert("warning", "simple", "El comentario no puede estar vacio", "The comment cannot be empty");
        }
        else if(strlen($this->contenido) > 255){
            self::$errors = createAlert("warning", "simple", "El comentario es muy extenso (Max 255 caracteres)", "The comment is very long (Max 255 characters)");
        }
        else if(!Exposiciones::find($this->id_exposicion)){
            self::$errors = true;
        }
        else if(!Usuarios::find($this->id_usuario)){
            self::$errors = true;
        }
    }
}

?>