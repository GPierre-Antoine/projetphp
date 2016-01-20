<?php

$base = $_SERVER['DOCUMENT_ROOT']."src/";

include_once($base.'util/regex.php');

include_once($base.'util/encryption.php');

class ControllerInscription extends Controller {
    public function __construct(Model $model) {
        parent::__construct($model);
    }// ControllerInscription

    public function update() {

        if (isset($_POST['mail']) && isset($_POST['pwd0'])) {

            $mail = mail_strip($_POST['mail']);
            $password = secure_strip($_POST['pwd0']);
            if ($password !== secure_strip($_POST['pwd1'])) {
                //do not match


                return;
            }
            $name = secure_strip($_POST['fName']);

            $crypt = true;
            $key = random_string_token(10,$crypt);


            $mail = $mail['mail'];


            $this->model->select_user_by_mail();
            $this->model->select($mail);
            $this->model->join('PASSWORD');

            $this->model->update();

            if ($this->model->rowCount() === 0) {
                //user not found -> good case

                $user = new User('0',$mail,$name,0);

                $this->model->create_new_user($user,$password,$key);

                $destinataire = $mail;
                $sujet = "Activation de votre compte";
                $entete = "From: test@aaron-aaron.com";
                $message = "Bienvenue sur VotreSite,

                Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
                ou copier/coller dans votre navigateur internet.,
                http://aaron-aaron.alwaysdata.net/confirmation/$key

               ---------------
               Ceci est un mail automatique, Merci de ne pas y répondre.";

                mail($destinataire, $sujet, $message, $entete);

            }
            else {
                //mail already exists;
            }
        }
    }
}
