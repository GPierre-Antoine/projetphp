<?php

$base = $_SERVER['DOCUMENT_ROOT']."src/";

include_once($base.'util/regex.php');

include_once($base.'util/encryption.php');

class ControllerInscription extends Controller {
    public function __construct(Model $model) {
        parent::__construct($model);
    }// ControllerInscription

    public function update() {

        if(mail_check(POST('mail')) == false)
        {
            echo 'Votre adresse est invalide';
        }
        else {

            if (isset($_POST['mail']) && isset($_POST['pwd0'])) {

                $mail = POST('mail');
                $password = POST('pwd0');
                if ($password !== POST('pwd1')) {
                    //do not match

                    return;
                }

                /*if (!mail_check($mail))
                {
                    $_SESSION['INSCRIPTION_FAILURE'] = "Adresse Email Non Valide !";
                    unset($_SESSION['INSCRIPTION_FAILURE']);
                    return;
                }*/

                $name = POST('fName');

                $crypt = true;
                $key = random_string_token(10, $crypt);


                $this->model->select_user_by_mail();
                $this->model->select($mail);
                $this->model->join('PASSWORD');

                $this->model->update();

                if ($this->model->rowCount() === 0) {
                    //user not found -> good case

                    $user = new User('0', $mail, $name, 0);

                    $this->model->create_new_user($user, $password, $key);

                    $destinataire = $mail;
                    $sujet = "Activation de votre compte";
                    $entete = "From: Equipe@aaron-aaron.com";
                    $message = "Bienvenue sur Aaron,

                Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
                ou copier/coller dans votre navigateur internet.,
                http://aaron-aaron.alwaysdata.net/confirmation/$key

               ---------------
               Ceci est un mail automatique, Merci de ne pas y répondre.";

                    mail($destinataire, $sujet, $message, $entete);

                    echo "Un mail vous a été envoyé sur votre adresse mail, veuillez suivre les indications pour
                continuer votre inscription.";

                } else {
                    //mail already exists;
                    //$_SESSION["INSCRIPTION_FAILURE"] = "Cette adresse email existe déjà dans nos bases de données !";

                }
            }
        }
    }
}
