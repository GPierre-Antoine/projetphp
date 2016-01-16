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
        $sql = "INSERT INTO ARTICLE (IDUSER,TITLE,THEME,URL,CONTENT) VALUES (".$_SESSION['ID'].",'" . $array[0]."','" . $array[1]."','" . $array[2] . "', '". $array[3] . "')";
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
        if(!isset($array[1]))return;
        $sql = "INSERT INTO CATEGORIE (IDUSER,NAME,COLOR) VALUES ('".$_SESSION['ID']."','" . $array[1]."','" . $array[2] . "')";
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

    public function refresh() {

    }

    public function getSpecific () {

    } // getSpecific


}