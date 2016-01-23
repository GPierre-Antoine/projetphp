<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 22/01/16
 * Time: 11:30
 */

abstract class StrategyResetPassword {
    protected $model;

    public function __construct ($model) {
        $this->model = $model;
    }

    public abstract function run();
}