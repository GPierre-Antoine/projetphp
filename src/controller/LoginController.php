<?php

$base = $_SERVER['DOCUMENT_ROOT']."src/";

include_once($base.'util/regex.php');

include_once($base.'util/encryption.php');


class LoginController extends Controller
{
    public function __construct(UserModel $model) {
        parent::__construct($model);
    }// ControllerConnection


    public function update ()
    {
        if (isset($_POST['mail']) && isset($_POST['pwd'])) {

            $mail = mail_strip($_POST['mail']);
            $password = secure_strip($_POST['pwd']);

            $mail = $mail['mail'];

            $this->model->select_user_by_mail();
            $this->model->select($mail);
            $this->model->join('PASSWORD');

            $this->model->update();



            if ($this->model->rowCount() === 0) {
                //user not found.
                echo "<p>User not found</p>";

            }
            else {


                $this->model->next();

                $token = $this->model->getData('TOKEN');

                $encoded = encrypt($password,$token);

                echo "<br />Token : ".bin2hex($token);
                echo "<br />of size : ". strlen($token);

                echo "<br />Encoded : ".bin2hex($encoded);
                echo "<br /> of size : " .strlen($encoded);
                echo "<br />Password : ".bin2hex($this->model->getData('PASSWORD'));
                echo "<br /> of size : " .strlen(bin2hex($this->model->getData('PASSWORD')));
                echo "<br />OpenSSL : ".     bin2hex(openssl_random_pseudo_bytes(64,$crypto_strong));
                echo "<br /> of size : ".strlen(openssl_random_pseudo_bytes(64,$crypto_strong));


                //user exists
                if ($encoded === $this->model->getData('PASSWORD')) {

                    //password matches
                    //$_SESSION['user'] = build_user($this->model->getData("ID"));
                    echo "<p>Logged</p>";

                }
                else {
                    //password does not match

                    echo "<p>Oups ! Problem.</p>";
                }


            }
        }
        return;
    }

}