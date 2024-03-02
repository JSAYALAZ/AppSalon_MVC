<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $router->render('auth/login',[

        ]);
    }
    public static function logout(Router $router){
        echo 'desde logout';
    }
    public static function olvide(Router $router){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
        }
        $router->render('auth/olvide',[

        ]);
    }
    public static function recuperar(Router $router){
        echo 'desde recuperar';
    }
    public static function crear(Router $router){
        $usuario=new Usuario;
        $alertas= null;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();
            if(empty($alertas)){
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    //HASHEAR PASSWORD
                    $usuario -> hashPassword();
                    $usuario -> crearToken();
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);

                    //$email->enviarConfirmacion();
                    
                    //CREAR USUARIO
                    $resultado =$usuario->guardar();
                    if($resultado){

                    }
                }
            }
        }
        $router->render('auth/crear-cuenta',[
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }

    public static function confirmar(Router $router){
        echo 'desde recuperar';
    }
    

}