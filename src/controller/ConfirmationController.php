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

        $other_key = $this->options[0];

        $passdb = new \db\db_handler();
        $passdb->prepare("SELECT COUNT(*) AS NUMBER FROM USERS WHERE TOKEN = ?");
        $passdb->execute(array($other_key));

        $query = $passdb->fetch(PDO::FETCH_ASSOC);



        if ($query['NUMBER'] === '1') {
            $passdb->prepare("UPDATE USERS SET ENABLE = 1, TOKEN = '' WHERE TOKEN = ?");
            $passdb->execute(array($other_key));
            echo "ok !";
        }
        else {

        }

        $passdb->execute(array($other_key));






        //$this->model->test($key);


        /*
         $key =$this->options[0];

        $this->model->select($_SESSION['ID'],$key);

        $this->model->update();

        $this->model->next();

        $this->model->getData

        $this->model->validate_inscriptions($id, $key);(''); */
    }
}
