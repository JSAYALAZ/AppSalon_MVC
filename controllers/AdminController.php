<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController{
    public static function index(Router $router){
        session_start();
        if($_SESSION['admin']!='1'||$_SESSION['login']!=true){
            header('Location: /');
        }
        $fecha = $_GET['fecha'];

        if($_GET==null){
            $fecha = date('Y-m-d');
        }else{
            $fecha = explode('-',$fecha);
            if(checkdate($fecha[1],$fecha[2],$fecha[0])){
                $fecha = $_GET['fecha'];
            }else{
                header('Location: /404');
            }
        }

        //CONSULTAR LA BASE DE DATOS
        $consulta = "SELECT citas.id, citas.hora, CONCAT(usuarios.nombre,' ',usuarios.apellido)AS cliente, ";
        $consulta.= "usuarios.email, usuarios.celular, servicios.nombre AS servicio, servicios.precio ";
        $consulta.= "FROM citas ";
        $consulta.= "LEFT OUTER JOIN usuarios ON citas.usuarioId=usuarios.id ";
        $consulta.= "LEFT OUTER JOIN citasservicios ON citasservicios.citaId = citas.id ";
        $consulta.= "LEFT OUTER JOIN servicios ON servicios.id = citasServicios.servicioId ";
        $consulta.= "WHERE citas.fecha = '$fecha'";
        $citas = AdminCita::SQL($consulta);


        $router->render('admin/index',[
            'nombre'=>$_SESSION['nombre'],
            'citas'=>$citas,
            'fecha'=>$fecha
        ]);
    }
}