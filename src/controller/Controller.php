<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 14/12/15
 * Time: 15:42
 */


class Controller {
    protected $model;//Target model
    protected $options = array();

    public function addOptions () {
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