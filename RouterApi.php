<?php
require_once 'libs/Router.php';
require_once 'api/controllers/api.controller.php';
require_once 'api/controllers/motos.api.controller.php';
require_once 'api/controllers/modelos.api.controller.php';
require_once 'api/controllers/user.api.controller.php';

$router = new Router();

$router->addRoute('motos', 'GET', 'MotosApiController', 'getMoto');
$router->addRoute('motos/filtrar', 'GET', 'MotosApiController', 'getMotoFiltrada');
$router->addRoute('motos/:ID', 'GET', 'MotosApiController', 'getMoto');
$router->addRoute('motos/:ID/:subrecurso', 'GET', 'MotosApiController', 'getMoto');
$router->addRoute('motos/:ID', 'PUT', 'MotosApiController', 'editMoto');
$router->addRoute('motos', 'POST', 'MotosApiController', 'insertMoto');

$router->addRoute('modelos', 'GET', 'ModelosApiController', 'getModelo');
$router->addRoute('modelos/:modelo', 'GET', 'ModelosApiController', 'getModelo');
$router->addRoute('modelos/:modelo/:subrecurso', 'GET', 'ModelosApiController', 'getModelo');
$router->addRoute('modelos/:modelo', 'PUT', 'ModelosApiController', 'editModelo');
$router->addRoute('modelos', 'POST', 'ModelosApiController', 'insertModelo');

$router->addRoute('auth/token', 'GET', 'UserApiController', 'getToken');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>