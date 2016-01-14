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

    public function recup_key_inscription ($id) {
        $this->pdo->prepare("SELECT TOKEN,ACTIF FROM VERIFICATION WHERE ID LIKE :ID");
        $this->pdo->execute(array(":ID" => $id));
    }

    public function validate_inscription($id) {
        $this->pdo->prepare("UPDATE VERIFICATION SET ACTIF = 1 WHERE ID LIKE :ID");
        $this->pdo->execute(array($id));
    }

    protected function getSpecific()
    {
        // TODO: Implement getSpecific() method.
    }
}
