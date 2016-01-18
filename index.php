<?php
$sessionStart = session_start();

include_once ("src/util/auto_class_load.php");


if(!isset($_SESSION['logged'])) {
  $_SESSION['logged'] = false;
}


//initialization of database
include_once("src/util/db_wrap.php");

$connexion = new \db\db_handler();
$connexion->init();


//Routing initialization
include_once("src/Router.php");

$router = new Router();


//URL rewriting
$task = explode ('/',$_SERVER["REQUEST_URI"]);

//get the right route from the first parameter
$route = $router->getRoute($task[1]);

//get correct MVC bloc
$model = new $route->model;
$controller = new $route->controller($model);
$view = new $route->view($model);

require_once("src/util/regex.php");


//var_dump($task);
if (count($task) > 2) {
$options = array_slice($task,2);
    foreach ($options as $value)
        if (empty($value) === false) {
            $controller->addOption(strip_all("/[^\w]/",$value));
        }
}



//let the controller update the model and the view display the model according to itself
//interruption by exception, for instance, inscription -> user already exists
try {
    $controller->update();
    $view->display();
} catch (exception $e) {
    echo $e->getMessage();
}

//close db connexion
$connexion->close();
$connexion = null;
