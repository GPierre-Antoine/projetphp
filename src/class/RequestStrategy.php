<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 22/01/16
 * Time: 11:40
 */

class RequestStrategy extends StrategyResetPassword {

    public function run()
    {
        echo <<<TEXT

        <p> Veuillez ajouter votre adresse mail afin d'obtenir un nouveau mot de passe</p>
        			    <form action="/reset" method="post">
        			    	<input class="bigInput" name="password" type="password" placeholder="Mot de passe" required/><br/>
        			    	<input class="bigInput" name="password" type="password" placeholder="Verification mot de passe" required/><br/>
        			    	<input id="submitIndex" name="action" type="submit" value="Valider" />
        			    </form>
TEXT;
    }
}