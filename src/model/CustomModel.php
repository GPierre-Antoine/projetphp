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

    //////////////////////////ADMIN/////////////////////////////////
    public function enableOrDisableUser($enableOrDisable,$id) {
        // Active ou désactive l'utilisateur
        if($enableOrDisable === "ena") {
            $sql = "UPDATE USERS SET ENABLE = 0 WHERE ID = " . $id;
        }
        else {
            $sql = "UPDATE USERS SET ENABLE = 1 WHERE ID = " . $id;
        }
        $this->pdo->query($sql);
    } // enableOrDisableUser()

    public function deleteUser($id) {
        // Supprime un utilisateur
        $sql = 'DELETE FROM FRIEND WHERE IDUSER='.$id.' AND IDFRIEND = '.$id;
        $this->pdo->query($sql);
        $sql = 'DELETE FROM CATEGORIE WHERE IDUSER='.$id;
        $this->pdo->query($sql);
        $sql = 'DELETE FROM ARTICLE WHERE IDUSER='.$id;
        $this->pdo->query($sql);
        $sql = 'DELETE FROM USERS WHERE ID='.$id;
        $this->pdo->query($sql);
    } // deleteUser()
    //////////////////////////ADMIN/////////////////////////////////

    //////////////////////////USER//////////////////////////////////
    public function addArticle($articleToAdd) {
        $sql = "INSERT INTO ARTICLE (IDUSER,TITLE,THEME,URL,CONTENT) VALUES (".$_SESSION['ID'].",'" . $articleToAdd[0]."','" . $articleToAdd[1]."','" . $articleToAdd[2] . "', '". $articleToAdd[3] . "')";
        $this->pdo->query($sql);
    } // addArticle()

    public function addCategory($categorieToAdd) {
        if(!isset($categorieToAdd[1]))return;
        $sql = "INSERT INTO CATEGORIE (IDUSER,NAME,COLOR) VALUES ('".$_SESSION['ID']."','" . $categorieToAdd[1]."','" . $categorieToAdd[2] . "')";
        $this->pdo->query($sql);
    } // addCategory()

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
        $sql = 'SELECT * FROM FLUX_INFORMATION WHERE IDFLUX IN (SELECT ID FROM FLUX WHERE URL = \''.$url.'\')';
        $stmt = $this->pdo->query($sql);
        $array = array();
        while($result = $stmt->fetch()) {
            $fluxArt = new FluxArticle($result['TITLE'],$result['POSTED'],$result['CONTENT'],$result['URL'],$result['MD5VERSION']);
            array_push($array,$fluxArt->display_rss());
        }
        return json_encode($array);
    }

    public function addFlux($name,$cat,$url) {
        $sql = "SELECT ID FROM CATEGORIE WHERE IDUSER = ".$_SESSION['ID']." AND NAME = \"".$cat."\"";
        $resultCate = $this->pdo->query($sql)->fetch();
        $idCate = $resultCate[0];

        $sql = "SELECT count(*) FROM FLUX WHERE URL = \"".$url."\"";
        $resultVerif = $this->pdo->query($sql)->fetch();
        if($resultVerif[0] == 0) {
            $sql = "INSERT INTO FLUX(URL) VALUES(\"".$url."\")";
            $this->pdo->query($sql);
            $idFlux = $this->pdo->lastInsertId();

            $sql = "INSERT INTO FLUX_ASSOC(IDCATE,IDFLUX,NAME,ISFAVORITE) VALUES(".$idCate.",".$idFlux.",\"".$name."\",0)";
            $this->pdo->query($sql);

            $flux = new Flux($idFlux,$url);
            $flux->refresh();
        } else {
            $sql = "SELECT ID FROM FLUX WHERE URL = \"".$url."\"";
            $resultFlux = $this->pdo->query($sql)->fetch();
            $idFlux = $resultFlux[0];

            $sql = "INSERT INTO FLUX_ASSOC(IDCATE,IDFLUX,NAME,ISFAVORITE) VALUES(".$idCate.",".$idFlux.",\"".$name."\",0)";
            $this->pdo->query($sql);
        }

    }

    public function userToDisplay($userToFind) {
        $sql = 'SELECT USERS.ID, NAME, AVATAR FROM USERS, USER_INFORMATION WHERE USERS.ID = USER_INFORMATION.ID AND ENABLE = 1 AND USERS.ID <> '.$_SESSION['ID'].' AND USERS.NAME = "'.$userToFind.'"';
        $stmt = $this->pdo->query($sql);
        $array = array();
        while($result = $stmt->fetch()) {
            array_push($array,$result['ID']);
            array_push($array,$result['NAME']);
            array_push($array,$result['AVATAR']);
        }
        return json_encode($array);
    }

    public function refresh() {

    }

    public function getSpecific () {

    } // getSpecific


}