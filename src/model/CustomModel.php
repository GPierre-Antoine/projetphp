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
        $sql = "INSERT INTO ARTICLE (IDUSER,TITLE,THEME,URL,CONTENT) VALUES (1,'" . $array[0]."','" . $array[1]."','" . $array[2] . "', '". $array[3] . "')";
        $this->pdo->query($sql);
    }

    public function getSpecific () {

    } // getSpecific
}