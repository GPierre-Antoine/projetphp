<?php


include_once("Route.php");
class Router {
    private $table;
    public function __construct() {
        $this->table = array();


        $this->table['default'] =
            new Route ('IndexModel','InscriptionView','IndexController');
        $this->table['user'] = new Route ('UserModel','UserParamView','SingleUserController');
        $this->table['defaultlogged'] = new Route ('DefaultModel','DefaultView','DefaultController');
    }

    public function getRoute($name)
    {
        $name = strtolower($name);
        if (array_key_exists($name,$this->table))
        {
            return $this->table[$name];
        }
        else {
            //if the route not exist and you are logged, this line is pass
            if($_SESSION['logged'] === true)
              return $this->table['defaultlogged'];
            return $this->table['default'];
		}
	}
}
