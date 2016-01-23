<?php
/**
 * Created by PhpStorm.
 * User: g20901528
 * Date: 22/01/16
 * Time: 11:40
 */

class SetMailStrategy extends StrategyResetPassword{

    public function run()
    {
        echo<<<TEXT
        			<div id="formReset" class="form">
        			    <p> Veuillez ajouter votre adresse mail afin d'obtenir un nouveau mot de passe</p>
        			    <form action="/reset" method="post">
        			    	<input class="bigInput" name="mail" type="email" placeholder="Adresse Mail" required/><br/>
        			    	<input id="submitIndex" name="action" type="submit" value="Valider" />
        			    </form>
        			</div>
TEXT;
    }
}