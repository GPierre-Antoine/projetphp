<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 22/01/16
 * Time: 12:05
 */

class ClickSurMailStrategy extends StrategyResetPassword{

    public function run()
    {
        echo<<<TEST
        <p>Nous vous avons envoyé un mail contenant un lien, veuillez le suivre pour réinitialiser votre mot de passe</p>
TEST;

    }
}