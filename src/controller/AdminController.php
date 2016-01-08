<?php

include_once("/home/aaron-aaron/www/src/controller/"."Controller.php");

class AdminController extends Controller {
    public function __construct(Model $model) {
        parent::__construct($model);

    }// ControllerInscription

    public function update() {
        //var_dump($this->options);
    }
}
