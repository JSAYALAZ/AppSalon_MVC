<?php
namespace Controllers;

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
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
        }
        $router->render('auth/crear-cuenta',[

        ]);
    }

}