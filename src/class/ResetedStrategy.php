<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 22/01/16
 * Time: 11:34
 */

class ResetedStrategy extends StrategyResetPassword {

    public function run()
    {
        header("Refresh:5;URL=/");
        die();
    }

}