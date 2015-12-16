<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 14/12/15
 * Time: 15:42
 */


class Controller {
    protected $model;//Target model

    public function __construct(Model $model) {
        $this->model = $model;
    }

    function getModel() {
        return $this->model;
    }// getModel
}