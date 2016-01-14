<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 08/01/16
 * Time: 14:09
 */

include_once('src/util/rss_feed.php');

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

    public function switchFavoriteFlux($value, $id) {
        $sql = "null" ;
        if ($value == "off") {
            $sql = 'UPDATE FLUX SET ISFAVORITE = 1 WHERE ID = ' . $id;
        }
        else {
            $sql = 'UPDATE FLUX SET ISFAVORITE = 0 WHERE ID = ' . $id;
        }
            $this->pdo->query($sql);
    }

    public function createFluxAndDisplay($url) {
        $f = rss_feed($url);
        $array = display_rss($f);
        return json_encode($array);
    }

    public function addFlux($name,$cat,$url) {

    }

    public function getSpecific () {

    } // getSpecific
}