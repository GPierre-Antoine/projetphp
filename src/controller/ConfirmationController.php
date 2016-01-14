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
        $this->model->get();
        $key =$_GET['code'] ;

        if ($row = $this->model->recup_key_inscription()->fetch())
        {
            $keybdd = $row['TOKEN'];
            $actif = $row['ACTIF'];
        }


        if ($actif = 1)
        {
            echo " Votre compte est déjà activé !";
        }
        else
        {
            if ($key == $keybdd)
            {
                echo "Votre compte a bien été activé";
                $this->model->validate_inscription();
            }
            else
            {
                echo "Votre ne peux être activé";
            }
        }
    }
}
