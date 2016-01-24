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
            $mail = POST('mail');
            $password = secure_strip(POST('pwd'));


            if (($val = $this->model->login_with_password($mail,$password)) !== 0)
            {
                if ($val === 1)
                    $field = "Le mot de passe entré est éronné";
                else
                    $field = "L'adresse mail est inconnue";
                echo<<<TEXT

                <p>Une erreur est survenue : <br/>
                {$field}
                </p>
TEXT;
                return;
            }
            else
            {
                echo "<p>Logged</p>";
                $testAdm = $this->model->isAdmin($_SESSION['ID']);
                if ($testAdm === 'admin') {
                    $_SESSION['admin'] = $testAdm;
                }
            }
        }
        return;
    }

}