<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 14/12/15
 * Time: 15:42
 */


trait Controller {
    private $model;//Target model

    function getModel() {
        return $this->model;
    }// getModel
}