<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){

        session_start();
        $nombre = $_SESSION['nombre'];
        $servicios = Servicio::all();

        $router->render('servicios/index',[
            'servicios'=>$servicios,
            'nombre'=>$nombre
        ]);
    }
    public static function crear(Router $router){
        echo 'Desde servicios';
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }
    }
    public static function actualizar(Router $router){
        echo 'Desde servicios';
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }
    }
    public static function eliminar(Router $router){
        if($_SERVER['REQUEST_METHOD']==='POST'){

        }
    }
}