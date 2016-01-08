<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:13
 */

 include_once('ModelPDO.php');

class ModelInscription extends ModelPDO {
    public function __construct() {
        parent::__construct();
    }

    public function insert(/*do_it*/) {
        $stmt = $this->pdo->prepare('SELECT * FROM *');
        $stmt->execute();
    }

    protected function getSpecific()
    {
        // TODO: Implement getSpecific() method.
    }


}
