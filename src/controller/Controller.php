<?php

class Controller {
    protected $model;//Target model
    protected $options = array();

    public function addOption () {
        $numarg = func_num_args();
        $args   = func_get_args();
        for ($i = 0;$i<$numarg;++$i)
        {
            $this->options[] = $args[$i];
        }
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