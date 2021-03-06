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
        if($_SESSION['admin'] === "admin"){
            header('Location:/admin');
        }
        else {
            echo '
			<html>
				<head>
					<title>Aaron</title>
					<link rel="stylesheet" type="text/css" href="/src/style/confirmation.css" />
				</head>
				<body>
				';

            if (isset($_SESSION["INSCRIPTION_FAILURE"]))
            {
                echo "<p>Un probl&egrave;me est survenu lors de l'inscription : ".$_SESSION["INSCRIPTION_FAILURE"]." </p>";
            }
            echo '
					<img class="logo" src="/src/images/aaron_logo_1.png">
				</body>
			</html>
    	';

            parent::redirect("/", 3);
        }
    }

}