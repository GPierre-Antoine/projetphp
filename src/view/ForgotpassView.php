<?php

include_once('View.php');

class ForgotpassView extends View {
	public function __construct($model) {
		$this->model=$model;
	}

	public function display()
	{
		echo "<html>
				<head>
					<title>Aaron</title>
					<link rel='stylesheet' type='text/css' href='src/style/user.css' />
					<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
					<script type='text/javascript' src='src/js/jquery.magnific-popup.js' ></script>
				</head>
				<body>
					<!-- TOP SIDE -->
					<div id='top'>
						<img class='logo' src='src/images/aaron_logo.png'>
						<p> 'Réinitialisation de votre mot de passe' </p>
						<a href='#'' onclick='javascript:;'' class='preference_btn'></a>
					</div>

					<section>
						<div class='central'>
							<div class='container'>
								<div class='content'>
									<form name='requestnewpassword' method='post' action=' '>
										<input class='bigInput' name='mail' type='email' placeholder='Adresse Mail' required/><br/>
										<button type='submit' id='newpassordx'>
									</form>
								</div>
							</div>
						</div>
					</section>
				</body>
			</html>";
		}

}