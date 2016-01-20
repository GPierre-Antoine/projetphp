<?php
/**
 * Created by Kevin.
 * User: h13002021
 * Date: 21/12/15
 * Time: 22:53
 */

 include_once('ModelPDO.php');

class ConfirmationModel extends ModelPDO {

    public function __construct() {
        parent::__construct();
    }


    public function insert() {

    }

    public function get () {
    }

    public function validate_inscription($param){
        $other_key = $param;

        $passdb = new \db\db_handler();
        $passdb->prepare("SELECT COUNT(*) AS NUMBER FROM USERS WHERE TOKEN = ?");
        $passdb->execute(array($other_key));

        $query = $passdb->fetch(PDO::FETCH_ASSOC);

        if ($query['NUMBER'] === '1') {
            $passdb->prepare("UPDATE USERS SET ENABLE = 1, TOKEN = '' WHERE TOKEN = ?");
            $passdb->execute(array($other_key));
            echo "Votre compte a bien été crée !";
        }
        else {
            echo "Votre compte ne peut être crée ! ";
        }

        $passdb->execute(array($other_key));
    }

    public function redirect ($url, $time = 5)
    {
        header("Refresh:$time;URL=$url");
        die();
    }

    protected function getSpecific(){
    }
}