<?php
require_once 'libs/Router.php';
require_once 'api/controllers/api.controller.php';

$router = new Router();

$router->addRoute('motos', 'GET', 'apiController', 'getMoto');
$router->addRoute('motos/filtrar', 'GET', 'apiController', 'getMotoFiltrada');
$router->addRoute('motos/:ID', 'GET', 'apiController', 'getMoto');
$router->addRoute('motos/:ID/:subrecurso', 'GET', 'apiController', 'getMoto');
$router->addRoute('motos/:ID', 'DELETE', 'apiController', 'deleteMoto');
$router->addRoute('motos/:ID', 'PUT', 'apiController', 'editMoto');
$router->addRoute('motos', 'POST', 'apiController', 'insertMoto');

$router->addRoute('modelos', 'GET', 'apiController', 'getModelo');
$router->addRoute('modelos/:modelo', 'GET', 'apiController', 'getModelo');
$router->addRoute('modelos/:modelo/:subrecurso', 'GET', 'apiController', 'getModelo');
$router->addRoute('modelos/:modelo', 'DELETE', 'apiController', 'deleteModelo');
$router->addRoute('modelos/:modelo', 'PUT', 'apiController', 'editModelo');
$router->addRoute('modelos', 'POST', 'apiController', 'insertModelo');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>