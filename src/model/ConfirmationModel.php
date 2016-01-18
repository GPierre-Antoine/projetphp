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

     public function recup_key_inscription ($mail) {
        $sql = $this->pdo->prepare('SELECT TOKEN,ACTIF FROM USERS WHERE ACTIF = 0 AND EMAIL = \''.$mail.'\'');
         $this->pdo->query($sql);

    }

    public function data_elements() {
        $this->pdo->prepare("SELECT TOKEN,ACTIF FROM USERS WHERE ACTIF = 0 AND EMAIL= ?");
        $this->pdo->fetch();
    }

    public function validate_inscription($mail) {
        $this->pdo->prepare("UPDATE USERS SET ACTIF = 1 WHERE EMAIL= ?");
        $this->pdo->execute(array($mail));
    }

    protected function getSpecific()
    {
        return " ";
    }
}
