<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiController;
use Controllers\CitaController;
use Controllers\LoginController;
use MVC\Router;

$router = new Router();

//INICIAR SESION
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//RECUPERAR PASSWD
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//CREAR CUENTA
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);


//AREA PRIVADA
$router->get('/cita',[CitaController::class,'index']);

//API DE CITAS
$router->get('/api/servicios',[ApiController::class, 'index']);
$router->post('/api/citas',[ApiController::class, 'guardar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();