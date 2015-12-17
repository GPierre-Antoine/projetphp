<?php
$sessionStart = session_start();

include_once("src/Router.php");
include_once("src/util/db_wrap.php");
\DB\db_handler::init();

$router = new Router();
$path = $_SERVER["REQUEST_URI"];

$matches = array();
$task = preg_match("/^\/?([a-zA-Z0-9\-\_]+)\/?(.*)$",$path,$matches);

$route = $router->getRoute($matches[1]);



echo "Controller : $route->controller <br /> Model : $route->model <br /> View : $route->view";

/*
$model = new $route->model;
$controller = new $route->controller($model,$matches[2]);
$view = new $route->view($model);

$controller->update();
$view->display();
*/

\DB\db_handler::close();