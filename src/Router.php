<?php


include_once("Route.php");
class Router {
    private $table;


    public function __construct() {
        $this->table = array();


        $this->table['default'] =
            new Route ('IndexModel','IndexView','IndexController');
        $this->table['confirmation'] = new Route ('ConfirmationModel','EmptyView', 'ConfirmationController');
        $this->table['user'] = new Route ('UserModel','UserView','UserController');
        $this->table['defaultlogged'] = new Route ('DefaultModel','DefaultView','DefaultController');
        $this->table['login'] = new Route ('UserModel','LoginView','LoginController');
        $this->table['settings'] = new Route ('DefaultModel','SettingsView','SettingsController');
        $this->table['admin'] = new Route ('AdminModel','AdminView','AdminController');
        $this->table['ajx'] = new Route ('CustomModel','EmptyView','AjaxController');
        $this->table['register'] = new Route ('UserModel','EmptyView','ControllerInscription');
        
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
