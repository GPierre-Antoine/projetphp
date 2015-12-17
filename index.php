<?php
//$sessionStart = session_start();
include_once("src/util/mvc_catcher.php");
include_once("src/util/db_wrap.php");
include_once("src/Router.php");
include_once("src/util/db_wrap.php");

$connexion = new \db\db_handler();
$connexion->init();

$router = new Router();
$path = $_SERVER["REQUEST_URI"];

$matches = array();
$task = preg_match("/^\/?([a-zA-Z0-9\-\_]+)\/?(.*)$/",$path,$matches);

$route = $router->getRoute($matches[1]);

include_once($models[$route->model]);
include_once($controllers[$route->controller]);
include_once($views[$route->view]);

$model = new $route->model;
$controller = new $route->controller($model,$matches[2]);
$view = new $route->view($model);

$controller->update();
$view->display();

$connexion->close();
$connexion = null;

