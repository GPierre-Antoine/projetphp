<?php
/**
 * Created by Kevin.
 * User: h13002021
 * Date: 21/12/15
 * Time: 22:01
 */

include_once('View.php');

class ConfirmationView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }// UserView

    public function display() {
    	echo '
			<html>
				<head>
					<title>Aaron</title>
					<link rel="stylesheet" type="text/css" href="src/style/confirmation.css" />
				</head>
				<body>
					<img class="logo" src="src/images/aaron_logo_1.png">
					<div class="validation">
						<form id="F_confirmation" action="confirmation" method="post">
							<input class="code" name="code" type="text" placeholder="Code de validation" required/>
						    <input class="submit" name="action" type="submit" value="Vérifier"/>
						</form>
						<p class="help">Je n\'ai pas reçu mon code d\'activation : <a class="sendCode" href="#">Renvoyer le code</a></p>
					</div>
				</body>
			</html>
    	';
    }

}