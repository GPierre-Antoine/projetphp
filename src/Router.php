<?php


include_once("Route.php");
class Router {
    private $table;
    public function __construct() {
        $this->table = array();

        $this->table['default'] =
            new Route ('DefaultModel','DefaultView','DefaultController');
        $this->table['user'] = new Route ('UserModel','UserParamView','SingleUserController');
    }

    public function getRoute($name)
    {
        $name = strtolower($name);
        if (array_key_exists($name,$this->table))
        {
            return $this->table[$name];
        }
        else
            return $this->table['default'];
    }
}