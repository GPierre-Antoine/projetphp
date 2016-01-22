<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 22/01/2016
 * Time: 09:30
 */

include_once('View.php');

class ResetView extends View {

    public function __construct($model) {
        parent::__construct($model);
    }// UserView

    public function display() {
        echo '
			<html>
				<head>
					<title>Aaron - Reset</title>
					<link rel="stylesheet" type="text/css" href="/src/style/reset.css" />
				</head>
				<body>
					<img class="logo" src="/src/images/aaron_logo_1.png">';

        $this->model->getStrategy()->run();

		echo '    </body>
			</html>
    	';
    }

}