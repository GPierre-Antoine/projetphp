<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 14/12/15
 * Time: 15:42
 */

trait Controller {
    var $route;//String
    Model $model;//Target model
    View $view;//target View

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