<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 22/01/16
 * Time: 11:30
 */

abstract class StrategyResetPassword {

    public function __construct () {
    }

    public function __toString()
    {
        return static::class;
    }

    public abstract function run();
}