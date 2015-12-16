<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 16/12/15
 * Time: 17:26
 */

class Route {
    public $model;
    public $view;
    public $controller;

    public function __construct($model, $view, $controller)
    {
        $this->model = $model;
        $this->view = $view;
        $this->controller = $controller;
    }
}