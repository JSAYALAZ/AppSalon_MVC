<?php
namespace Model;

class AdminCita extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB =[
        'id',
        'hora',
        'cliente',
        'email',
        'celular',
        'servicio',
        'precio'
    ];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $celular;
    public $servicio;
    public $precio;

    public function __construct($args=[]){
        $this->id=$args['id']??null;
        $this->hora=$args['hora']??'';
        $this->cliente=$args['cliente']??'';
        $this->email=$args['email']??'';
        $this->celular=$args['celular']??'';
        $this->servicio=$args['servicio']??'';
        $this->precio=$args['precio']??'';
    }
}