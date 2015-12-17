<?php
//$sessionStart = session_start();

//initialization of arrays containing pathname from classname
include_once("src/util/mvc_catcher.php");

//initialization of database
include_once("src/util/db_wrap.php");

$connexion = new \db\db_handler();
$connexion->init();

//Routing initialization
include_once("src/Router.php");

$router = new Router();


//URL rewriting
$path = $_SERVER["REQUEST_URI"];

//$matches[1] contains the first tokken in the url until the first non alphanum
//$matches[2] contains all the rest
$matches = array();
$task = preg_match("/^\/?([a-zA-Z0-9\-\_]+)\/?(.*)$/",$path,$matches);


//get the right route from the first parameter
$route = $router->getRoute($matches[1]);

//include according files
include_once($models[$route->model]);
include_once($controllers[$route->controller]);
include_once($views[$route->view]);


//get correct MVC bloc
$model = new $route->model;
$controller = new $route->controller($model,$matches[2]);
$view = new $route->view($model);

//let the controller update the model and the view display the model according to itself
//interruption by exception, for instance, inscription -> user already exists
try {
    $controller->update();
    $view->display();
} catch (exception $e) {
    //TODO
}

//close db connexion
$connexion->close();
$connexion = null;

