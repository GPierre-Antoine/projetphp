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

        $name = $_GET['log'];
        $key = $_GET['key'];

        $pdo = new \db\db_handler();

        $stmt = $pdo->prepare("Select TOKEN, ACTIF FROM USERS WHERE NAME = 'romae' ");
        var_dump($stmt->fetch()); //lecture de la requete
        /*if($stmt->execute(array(':name'=>$name)) && $data = $stmt->fetch())
        {
            $keybdd = $data['TOKEN'];
            $actif = $data['ACTIF'];
        }

        if($actif == 1)
            echo "Votre compte est déjà activé.";
        else
        {
            if($key == $keybdd)
            {
                echo "Votre compte à bien été activé.";
                $stmt = "UPDATE USERS SET ACTIF = 1 WHERE NAME LIKE :NAME";
                $stmt->bindParam(':name',$name);
                $stmt->execute();

            }
            else
                echo "Votre compte ne peut être activé";
        } *

        /* $key =$this->options[0];

        $this->model->select($_SESSION['ID'],$key);

        $this->model->update();

        $this->model->next();

        $this->model->getData

        $this->model->validate_inscriptions($id, $key);(''); */
    }
}
