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

            $key = md5(microtime(TRUE)*100000);


            $mail = $mail['mail'];

            $this->model->select_user_by_mail();
            $this->model->select($mail);
            $this->model->join('PASSWORD');

            $this->model->update();


            $destinataire = $mail;
            $sujet = "test validation lol";
            $entete = "From: test@aaron-aaron.com";
            $message = "Salut je test si ca marche, <a href='http://aaron-aaron.alwaysdata.net/confirmation/".bin2hex($key)."'> lien </a>";




            if ($this->model->rowCount() === 0) {
                //user not found -> good case

                $crypto_strong = true;
                $bytes = openssl_random_pseudo_bytes(64,$crypto_strong);


                $user = new User('0',$mail,$name,0);

                $this->model->create_new_user($user,encrypt($password,$bytes),$bytes,$key);



                $mail($destinataire, $sujet, $message, $entete);

            }
            else {
                //mail already exists;
            }
        }
    }
}
