<?php

/**
 * Created by PhpStorm.
 * User: pierre-antoine
 * Date: 23/01/16
 * Time: 14:14
 */
class Not_To_EasyStrategy extends StrategyResetPassword
{

    public function run()
    {
        echo "<p>Les deux mots de passe entrés ne correspondent pas.</p>";
        $following = new RequestStrategy();
        $following.run();
    }
}