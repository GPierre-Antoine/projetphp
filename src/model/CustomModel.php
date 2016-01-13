<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 08/01/16
 * Time: 14:09
 */

class CustomModel extends ModelPDO {

    public function __construct() {
        parent::__construct();
    } // CustomModel

    public function addArticle($array) {
        $sql = "INSERT INTO ARTICLE (IDUSER,TITLE,THEME,URL,CONTENT) VALUES (3,'" . $array[0]."','" . $array[1]."','" . $array[2] . "', '". $array[3] . "')";
        $this->pdo->query($sql);
    }

    public function enableOrDisable($value,$id) {
        if($value == "ena") {
            $sql = "UPDATE USERS SET ENABLE = 0 WHERE ID = " . $id;
            $this->pdo->query($sql);
        }
        else {
            $sql = "UPDATE USERS SET ENABLE = 1 WHERE ID = " . $id;
            $this->pdo->query($sql);
        }
    }

    public function deleteUser($valueOfId) {
        $sql = 'DELETE FROM FRIEND WHERE IDUSER='.$valueOfId;
        $this->pdo->query($sql);
        $sql = 'DELETE FROM CATEGORIE WHERE IDUSER='.$valueOfId;
        $this->pdo->query($sql);
        $sql = 'DELETE FROM FLUX_ASSOC WHERE IDUSER='.$valueOfId;
        $this->pdo->query($sql);
        $sql = 'DELETE FROM ARTICLE WHERE IDUSER='.$valueOfId;
        $this->pdo->query($sql);
        $sql = 'DELETE FROM USERS WHERE ID='.$valueOfId;
        $this->pdo->query($sql);
    }

    public function addCategorie($array) {
        $sql = "INSERT INTO CATEGORIE (IDUSER,NAME,COLOR) VALUES ('" . $array[0]."','" . $array[1]."','" . $array[2] . "')";
        $this->pdo->query($sql);
    }

    public function getSpecific () {

    } // getSpecific
}