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

        $name = $_GET['name'];
        $key = $_GET['key'];
        $req = "Select TOKEN, EMAIL FROM USERS WHERE NAME = ?";
        if($this->pdo>execute($req, array($name)) && $data = $this->pdo->execute($req, array($name))->fetch())
        {
            $keybdd = $data['TOKEN'];
            $actif = $data['ACTIF'];
        }
        echo $keybdd;
        echo $actif;
        echo $key;
        echo $name;

        if($actif == 1)
            echo "Votre compte est déjà activé.";
        else
        {
            if($key == $keybdd)
            {
                echo "Votre compte à bien été activé.";
                $req = "UDATE VERIFICATION SET ACTIF = 1 WHERE ID = ?";
                $this->execute($req, array($name));

            }
            else
                echo "Votre compte ne peut être activé";
        }

        $this->model->get();
        /* $key =$this->options[0];

        $this->model->select($_SESSION['ID'],$key);

        $this->model->update();

        $this->model->next();

        $this->model->getData

        $this->model->validate_inscriptions($id, $key);(''); */
    }
}
