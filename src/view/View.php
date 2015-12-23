<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 14/12/15
 * Time: 15:54
 */

class View {

    protected $model;

    function __construct($model)
    {
        $this->model = $model;
    }



    public function display() {
    }
}