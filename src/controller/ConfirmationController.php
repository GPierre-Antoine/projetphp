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


    /*public function validate_inscriptions($id, $key)
    {
        $dbb = new \db\db_handler();
        $req = "SELECT TOKEN, ACTIVE FROM VERIFICATION Where ID = ?" ;


        if ($dbb->execute($req,(array($id))) && $row = $dbb->execute($req, array($id))->fetch() )
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
                $req = "UPDATE VERIFICATION SET ACTIF = 1 Where ID = ?";
                $dbb->execute($req, array($id));
            }
            else
            {
                echo "Votre compte ne peux être activé";
            }
        }
    } */

    public function update() {

        $this->model->get();
        $key = $this->options[0];
        $id = $_SESSION['ID'];
        $dbb = new \db\db_handler();
        $req = "SELECT TOKEN, ACTIVE FROM VERIFICATION Where ID = ?" ;

        if ($dbb->execute($req,(array($id))) && $row = $dbb->execute($req, array($id))->fetch() )
        {
            $keybdd = $row['TOKEN'];
            $actif= $row['ACTIF'];
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
                $req = "UPDATE VERIFICATION SET ACTIF = 1 Where ID = ?";
                $dbb->execute($req, array($id));
            }
            else
            {
                echo "Votre compte ne peux être activé";
            }
        }

        /*$key =$this->options[0];

        $this->model->select($_SESSION['ID'],$key);

        $this->model->update();

        $this->model->next();

        $this->model->getData

        $this->model->validate_inscriptions($id, $key);(''); */


    }
}
