<?php

namespace Model;

class Servicio extends ActiveRecord{
    //BASE DE DATOS
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id','nombre','precio'];

    public $id;
    public $nombre;
    public $precio; 

    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->nombre = $args['nombre']??'';
        $this->precio = $args['precio']??'';
    }

    public function validar(){
        $this->nombre==''?self::setAlerta('error', 'Nombre del servicio obligatorio'):'';
        $this->precio==''?self::setAlerta('error', 'Precio del servicio obligatorio'):'';
        // !is_numeric($this->precio)?self::setAlerta('error', 'Valor no valido'):'';
        return self::getAlertas();
    }
}

