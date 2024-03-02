<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $atributosDB = [
        'id',
        'nombre',
        'apellido',
        'email',
        'passwd',
        'celular',
        'admin',
        'confirmado',
        'token'
    ];
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $passwd;
    public $celular;
    public $admin;
    public $confirmado;
    public $token;
    public function __construct($args=[]){
        $this->id=$args['id']??null;
        $this->nombre=$args['nombre']??null;
        $this->apellido=$args['apellido']??null;
        $this->email=$args['email']??null;
        $this->passwd=$args['passwd']??null;
        $this->celular=$args['celular']??null;
        $this->admin=$args['admin'] ?? null;
        $this->confirmado=$args['confirmado']??null;
        $this->token=$args['token']??null;
    }

    public function validar(){
        !$this->nombre?self::setAlerta('login','Falta nombre'):'';
        !$this->apellido?self::setAlerta('login','Falta apellido'):'';
        !$this->email?self::setAlerta('login','Falta email'):'';
        !$this->passwd?self::setAlerta('login','Falta passwd'):'';
        !$this->celular?self::setAlerta('login','Falta celular'):'';
    }


}