<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:01
 */

$base = $_SERVER['DOCUMENT_ROOT']."src/";

include_once($base .'controller/Controller.php');

include_once($base.'util/regex.php');

include_once($base.'util/encryption.php');

class ControllerInscription extends Controller {
    public function __construct(Model $model) {
        parent::__construct($model);
    }// ControllerInscription

    public function update(/*do_it*/) {
        if (isset($_POST['mail']) && isset($_POST['pwd'])) {

            $mail = mail_strip($_POST['mail']);
            $password = secure_strip($_POST['pwd']);

            $mail = $mail['mail'];

            $this->model->select_user_by_mail();
            $this->model->select($mail);
            $this->model->join('PASSWORD');

            $this->model->update();



            if ($this->model->rowCount() === 0) {
                //user not found -> good case

                $bytes = openssl_random_pseudo_bytes(64,,);

                $user = new User(,,...);

                $this->model->insert($user,encrypt($password,$bytes),$bytes);


            }
            else {
                //mail already exists;
            }
        }
    }
}
