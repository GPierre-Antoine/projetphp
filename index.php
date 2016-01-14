<?php
$sessionStart = session_start();



spl_autoload_register(function($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'src/class/',
        'src/model/',
        'src/controller/',
        'src/view/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach( $dirs as $dir ) {
        if (file_exists($dir.$class_name.'.php')) {
            require_once($dir.$class_name.'.php');
            return;
        }
    }
});


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



$sql = "SELECT * FROM FLUX";
$stmt = $connexion->query($sql);
while ($result = $stmt->fetch())
{
    $newFlux = new Flux($result['ID'],$result['NAME'],$result['URL'],$result['ISFAVORITE']);
    $newFlux->refresh();
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
