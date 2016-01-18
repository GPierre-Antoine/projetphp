<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 16/12/15
 * Time: 17:01
 */

$base = $_SERVER['DOCUMENT_ROOT']."src/";

class ConfirmationController extends Controller {
    public function __construct(Model $model) {
        parent::__construct($model);

    }// ControllerInscription

    public function update() {

        $key = $_POST['code'];
        $mail = $_POST['mail'];

        $stmt = $this->model->recup_key_inscription($mail);

        echo "test";

        $stmt->fetch();

        if($stmt && $data = $this->model->data_elements())
        {
            $keybdd = $data['TOKEN'];
            $actif = $data['ACTIF'];
        }
        echo $keybdd;
        echo $actif;
        echo "2";

        if($actif == 1)
            echo "Votre compte est déjà activé.";
        else
        {
            if($key == $keybdd)
            {
                echo "Votre compte à bien été activé.";
                $this->model->validate_inscription($mail);
            }
            else
                echo "Votre compte ne peut être activé";
        }
        /*
         $key =$this->options[0];

        $this->model->select($_SESSION['ID'],$key);

        $this->model->update();

        $this->model->next();

        $this->model->getData

        $this->model->validate_inscriptions($id, $key);(''); */
    }
}
