<?php
namespace Controllers;

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
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);
            $usuario->validar();
            $alertas = $usuario->getAlertas();
            if(empty($alertas)){

            }
        }
        $router->render('auth/crear-cuenta',[
            'usuario'=>$usuario,
            'alertas'=>$alertas['login']
        ]);
    }
    

}