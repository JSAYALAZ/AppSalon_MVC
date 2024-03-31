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
                        session_start();
                        $_SESSION['id']= $usuario->id;
                        $_SESSION['nombre']= $usuario->nombre. ' '.$usuario->apellido ;
                        $_SESSION['email']= $usuario->email;
                        $_SESSION['login']=true;

                        //REDIRECIONAR
                        if($usuario->admin == '1'){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header("Location: /admin");
                        }else{
                            header("Location: /cita");
                        }
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
        session_start();
        $_SESSION=[];

        header('Location: /');
    }
    public static function olvide(Router $router){
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty( $alertas )){
                $usuario = Usuario::where('email',$auth->email);
                if($usuario && $usuario->confirmado =='1'){
                    $usuario->crearToken();
                    $usuario->guardar();
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito','revisa tu email');
                }else{
                    Usuario::setAlerta('error','Usuario no confirmado o no existe');
                }

            }
        }
        $alertas= Usuario::getAlertas();
        $router->render('auth/olvide',[
            'alertas'=>$alertas
        ]);
    }
    public static function recuperar(Router $router){
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

        //buscar usuario por el token
        $usuario = Usuario::where('token',$token) ?? null;

        if(is_null($usuario)){
            Usuario::setAlerta('error', 'token no valido');
            $error = true;
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $password = new Usuario($_POST);
            $password->validarPassword();
            $alertas = Usuario::getAlertas();
            
            if(empty($alertas)){
                $usuario->passswd = null;
                $usuario->passwd = $password -> passwd;
                $usuario->hashPassword();
                $usuario->token=null;
    
                $result = $usuario->guardar();
                if($result){
                    header('Location: /');
                }
            }
        }
        

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password',[
            'alertas'=>$alertas,
            'error'=>$error
        ]);
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