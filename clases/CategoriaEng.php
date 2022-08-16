<?php

namespace MUO;

class CategoriaEng extends Categorias{
    protected static $table = 'categoriaeng';
    protected static $dbColumn = ['id', 'nombre', 'id_categoria'];

    public $id_categoria;

    public function __construct($categoria)
    {
       $this->id = $categoria["id"] ?? '';
       $this->nombre = $categoria["nombre"] ?? ''; 
       $this->id_categoria = $categoria["id_categoria"] ?? '';
    }


}