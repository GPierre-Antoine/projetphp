<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 08/01/16
 * Time: 16:36
 */

class AjaxController extends  Controller {

    public function __construct($model) {
        parent::__construct($model);

    }

    function getModel() {
        return $this->model;
    }// getModel

    public function update() {
    }


}