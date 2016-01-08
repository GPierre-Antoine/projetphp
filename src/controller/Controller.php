<?php

class Controller {
    protected $model;//Target model
    protected $options = array();

    public function addOption ($option) {
        $this->options[] = $option;
    }

    public function __construct(Model $model) {
        $this->model = $model;
    }

    function getModel() {
        return $this->model;
    }// getModel

    public function update() {
    }
}