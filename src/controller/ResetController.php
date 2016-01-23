<?php

include_once("src/util/encryption.php");

class ResetController extends Controller {
	public function __construct(UserModel $model) {
		parent::__construct($model);
	}



    private function send_mail_for_validation ($mail,$token) {
        $destinataire = $mail;
        $sujet = "Changement de Mot de passe demandé";
        $entete = "From: no-reply@aaron-aaron.alwaysdata.net";
        $message = <<<TEXT
            Bienvenue sur Aaron,

            Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
            ou copier/coller dans votre navigateur internet.
            http://aaron-aaron.alwaysdata.net/reset/{$token}

           ---------------
           Ceci est un mail automatique, Merci de ne pas y répondre.
TEXT;

        mail($destinataire, $sujet, $message, $entete);

    }


	public function update()
    {
        if ($_SESSION["logged"] === true) {
            if (isset($_POST["password1"]) && isset($_POST["password2"]) && POST("password1") === POST("password2")) {
                //change password to new password

                $this->model->reset_password_with_id($_SESSION["id"], POST("password1"));
                $this->model->setStrategy(new PasswordChangedStrategy());
            }
            else
            {
                $this->model->setStrategy(new Not_To_EasyStrategy());
            }

        }
        else {
            echo "5";
            /**not logged in waiting for either :
             * -input mail
             * -input validation
             *
            */
            if (isset($this->options[0])) {
                echo "6";
                //validation du token

                $this->model->login_with_validation($this->options[0]);

                if ($_SESSION['logged'] === true) {
                    echo "7";
                    //is connected, now request a new password
                    $this->model->setStrategy(new RequestStrategy());

                }
                else {
                    echo "8";
                    //bad token, invalid ID;
                    $this->model->setStrategy(new SetMailStrategy());

                }


            }
            else {
                echo "9";

                //user wants to request a new password
                if (isset($_POST["mail"])) {
                    echo "A";

                    $this->model->setStrategy(new ClickSurMailStrategy());
                    $mail = POST("mail");
                    $token = $this->model->request_password_change($mail);

                    $this->send_mail_for_validation ($mail,$token);

                } else {
                    echo "B";

                    // no mail set ; need to display form
                    $this->model->setStrategy(new SetMailStrategy());
                }
            }
        }
    }

}