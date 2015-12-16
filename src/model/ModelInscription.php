<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:13
 */

class ModelInscription extends ModelPDO {
    public function __construct(PDO $pdo) {
        parent::__construct($pdo);
    }

    public function insert(/*do_it*/) {
        $stmt = $this->pdo->prepare('SELECT * FROM *');
        $stmt->execute();
    }

}