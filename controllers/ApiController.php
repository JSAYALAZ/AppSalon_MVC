<?php
namespace Controllers;

use Model\Servicio;


class ApiController{
    public static function index(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar(){
        $respuesta = [
            'mensaje'=> 'todo ok'
        ];

        echo json_encode($respuesta);
    }
}