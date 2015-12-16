<?php

include_once("src/Router.php");

$router = new Router();
$path = $_SERVER["REQUEST_URI"];
$matches = array();
$task = preg_match("/^\/?([a-zA-Z0-9\-\_]+)\/(.*)/",$path,$matches);


$route = $router->getRoute($matches[1]);

$model = new $route->model;
$controller = new $route->controller($model,$matches[2]);
$view = new $route->view($model);

$controller->update();
$view->display();
