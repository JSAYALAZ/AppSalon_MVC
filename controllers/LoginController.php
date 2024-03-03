<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas =[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                //USUARIO CON TODOS LOS DATOS
                $usuario = Usuario::where('email',$auth->email);
                if($usuario){
                    if( $usuario->comprobarPasswordAndVerificado($auth->passwd)){
                        debuguear('todo bien');
                    }else{
                        Usuario::setAlerta('error','No verificado o contrase;a incorrecta');
                    }
                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
                $alertas = Usuario::getAlertas();
            }
        }
        
        $router->render('auth/login',[
            'alertas'=>$alertas,
            'usuario'=>$auth
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
                    $email->enviarConfirmacion();
                    
                    //CREAR USUARIO
                    $resultado =$usuario->guardar();
                    if($resultado){
                        header("Location: /mensaje");
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
        $alertas = [];
        $token=s($_GET['token']);
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no valido');
        }else{
            $usuario->confirmado ='1';
            $usuario->token =null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Token valido, iniciando cuenta..');
            header('Location ./');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas'=>$alertas,
            'token'=>$token
        ]);
    }
    public static function mensaje(Router $router){
        $router->render('auth/mensaje',[

        ]);
    }
    

}