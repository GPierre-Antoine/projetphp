<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:13
 */

class ModelInscription extends ModelDBH {
    public function __construct(\db\db_handler $dbh) {
        parent::__construct($dbh);
    }// ModelInscription

    public function insert($information1, $information2) {
        $req = $this->pdo->prepare('INSERT INTO nom_de_la_table VALUES (\'' . $information1 . '\',\'' . $information2 .'\')');
        $req->execute();
    }// insert

}