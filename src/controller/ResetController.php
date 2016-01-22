<?php

include_once("src/util/encryption.php");

class ResetController extends Controller {
	public function __construct(UserModel $model) {
		parent::__construct($model);
	}

	public function update()
    {
        if (isset($this->options[0]) && isset($_POST["password1"]) && isset($_POST["password2"]) && $password = POST("password1") === POST("password2"))
        {
            //there is a token set.
            $token = $this->options[0];
            $this->model->reset_password_with_validation ($token,$password);


            $this->model->setState("reseted");
        }
        else {
            //user wants to request a new password
            if (isset($_POST["mail"])) {
                $mail = POST("mail");
                $token = $this->model->request_password_change($mail);

                $destinataire = $mail;
                $sujet = "Changement de Mot de passe demand&eacute;";
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
            else {
                // no mail set
            }
        }
    }

}