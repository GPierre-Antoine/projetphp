<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 17/12/15
 * Time: 16:23
 */

class ModelConnection extends ModelDBH {
    public function __construct(\db\db_handler $dbh)
    {
        parent::__construct($dbh);
    }// ModelConnection

    public function get($information1, $information2)
    {
        $req =pdo('SELECT * FROM USERS');
        while($data = mysqli_fetch_array($req)) {
            if($data['NICKNAME'] == $information1 & $data['PASSWORD'] == $information2) {
                //un bon test pour la connexion
            }
        }
    }// get
}