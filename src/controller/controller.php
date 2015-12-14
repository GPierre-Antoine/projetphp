<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 14/12/15
 * Time: 15:42
 */

require_once("../view/View.php");
require_once("../model/Model.php");

trait Controller {
    private $route;//String
    private $model;//Target model
    private $view;//target View

    function getRoute() {
        return $this->route;
    }// getRoute

    function getModel() {
        return $this->model;
    }// getModel

    function getView() {
        return $this->view;
    }//getView
}