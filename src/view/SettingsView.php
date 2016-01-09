<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 08/01/16
 * Time: 16:36
 */

include_once('View.php');

class SettingsView extends View {

    private $user;

    public function __construct($model) {
        $this->model = $model;
        $this->user = $this->model->getCurrentUser();
    }

    public function display() {
        echo '
    		<html>
				<head>
					<title>Aaron</title>
					<link rel="stylesheet" type="text/css" href="/src/style/settings.css" />
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				</head>
				<body>
					<!-- TOP SIDE -->
					<div id="top">
						<img class="top_logo" src="/src/images/aaron_logo.png">
						<span class="top_username"><strong>'.$this->user->getName().'</strong></span>
					</div>

					<div id="body">
					    <div id="param_account" class="param_box">

					    </div>
					    <div id="param_mail" class="param_box">

					    </div>
					    <div id="param_pwd" class="param_box">

					    </div>
					</div>
				</body>
			</html>
		';
    }
}