<?php

/**
 * Created by PhpStorm.
 * User: pierre-antoine
 * Date: 23/01/16
 * Time: 14:11
 */
class PasswordChangedStrategy extends StrategyResetPassword
{

    public function run()
    {
        echo <<<TEXT

        <p>Votre mot de passe à été changé !<br/> Clickez sur ce <a href="/">lien</a> pour retourner à la page principale ou attendez 5 secondes pour être automatiquement redirigé. </p>
TEXT;
        header("Refresh:5;URL=/");

    }
}