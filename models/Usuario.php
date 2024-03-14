<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
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
        $this->admin=$args['admin'] ?? '0';
        $this->confirmado=$args['confirmado']??'0';
        $this->token=$args['token']??null;
    }

    public function validar(){
        !$this->nombre?self::setAlerta('error','Falta nombre'):'';
        !$this->apellido?self::setAlerta('error','Falta apellido'):'';
        if($this->email){
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $this->email)) {
                self::setAlerta('error', 'Correo electrónico no válido');
            }
        }else{
            self::setAlerta('error','Falta email');
        }
        if($this->passwd){
            if(strlen($this->passwd)<8){
                self::setAlerta('error','Minimo de 8 caracteres');
            }
        }else{
            self::setAlerta('error','Falta passwd');
        }

        if($this->celular){
            if (!preg_match('/^\d{10}$/', $this->celular)) {
                self::setAlerta('error', 'Número de celular no válido');
            }
        }else{
            self::setAlerta('error','Falta celular');
        }
        
        return self::getAlertas();
    }

    public function validarLogin(){
        !$this->email?self::setAlerta('error','Falta email'):'';
        !$this->passwd?self::setAlerta('error','Falta password'):'';
        return self::getAlertas();
    }

    public function validarEmail(){
        !$this->email?self::setAlerta('error','Falta email'):'';
        return self::getAlertas();
    }

    public function existeUsuario(){
        $query = "SELECT * FROM ";
        $query .= self::$tabla;
        $query .= " WHERE email = '";
        $query .= $this->email;
        $query .= "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows){
            self::setAlerta('error','Usuario ya existe');
        }
        return $resultado;
    }

    public function hashPassword(){
        $this->passwd = password_hash($this->passwd, PASSWORD_BCRYPT);

    }
    public function crearToken(){
        $this->token = uniqid();
    }
    public function comprobarPasswordAndVerificado($passwd){
        $resultado = password_verify($passwd,$this->passwd);

        if(!$this->confirmado || !$resultado){
            self::$alertas['error'][]='Password incorrecto o tu cuenta no ha sido confirmada';
        }else{
            return true;
        }

    }
}