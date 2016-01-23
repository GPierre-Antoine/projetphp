<?php

/**
 * Created by PhpStorm.
 * User: pierre-antoine
 * Date: 23/01/16
 * Time: 14:14
 */
class Not_to_easyStrategy extends StrategyResetPassword
{

    public function run()
    {
        echo<<<TEST
        <p>Les deux mots de passe entrés ne correspondent pas.</p>
TEST;


        $following = new RequestStrategy($this->model);
        $following.run();
    }
}