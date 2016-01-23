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

    ////////////////////////////////////////////////////////////////////////ADMIN///////////////////////////////////////////////////////////////////////
    public function enableOrDisableUser($enableOrDisable,$idUser) {
        if($enableOrDisable === "ena") {
            $sql = "UPDATE USERS SET ENABLE = ? WHERE ID = ?";
            $this->pdo->prepare($sql);
            $this->pdo->execute(array(0,$idUser));
        }
        else {
            $sql = "UPDATE USERS SET ENABLE = ? WHERE ID = ?";
            $this->pdo->prepare($sql);
            $this->pdo->execute(array(1,$idUser));

        }
    } // enableOrDisableUser() : enable or disable a user of the database

    public function deleteUser($idUser) {
        $sql = 'DELETE FROM USERS WHERE ID = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($idUser));
    } // deleteUser() : delete a user of the database
    ///////////////////////////////////////////////////////////////////////~ADMIN///////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////FOR A USER/////////////////////////////////////////////////////////////////////

    public function userToFindAndToDisplay($userToFind) {
        $sql = 'SELECT count(*) FROM FRIEND WHERE IDUSER = ? AND IDFRIEND IN (SELECT ID FROM USERS WHERE NAME = ?)';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID'],$userToFind));
        $test = $this->pdo->fetch(\PDO::FETCH_NUM);
        $array = array();
        if ($test[0] == 0) {
            $sql = 'SELECT USERS.ID, NAME, AVATAR FROM USERS, USER_INFORMATION WHERE USERS.ID = USER_INFORMATION.ID AND ENABLE = 1 AND USERS.ID <> ? AND USERS.NAME = ?';
            $this->pdo->prepare($sql);
            $this->pdo->execute(array($_SESSION['ID'],$userToFind));
            while ($result = $this->pdo->fetch(\PDO::FETCH_ASSOC)) {
                array_push($array, $result['ID']);
                array_push($array, $result['NAME']);
                array_push($array, $result['AVATAR']);
            }
            return json_encode($array);
        }
        else {
            return "false";
        }
    } // userToFindAndToDisplay() : return an array or users found

    //////////////////////////////////////////////////////////////////////ARTICLE//////////////////////////////////////////////////////////////////////
    public function addArticle($articleToAdd) {
        $sql = "INSERT INTO ARTICLE (IDUSER,TITLE,THEME,URL,CONTENT,POSTED) VALUES (?,?,?,?,?,?)";
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID'],$articleToAdd[0],$articleToAdd[1],$articleToAdd[2],$articleToAdd[3],date('Y-m-d H:i:s')));
    } // addArticle() : add a article for the current user

    /////////////////////////////////////////////////////////////////////~ARTICLE//////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////RSS////////////////////////////////////////////////////////////////////////
    public function changeFavoriteRSSFeed($value, $idRSSFeed, $idCategory) {
        $sql = "null" ;
        if ($value == "on") {
            $sql = 'UPDATE FLUX_ASSOC SET ISFAVORITE = ? WHERE IDFLUX = ? AND IDCATE = ?';
            $this->pdo->prepare($sql);
            $this->pdo->execute(array(1,$idRSSFeed,$idCategory));
        }
        else {
            $sql = 'UPDATE FLUX_ASSOC SET ISFAVORITE = ? WHERE IDFLUX = ? AND IDCATE = ?';
            $this->pdo->prepare($sql);
            $this->pdo->execute(array(0,$idRSSFeed,$idCategory));
        }
    } // changeFavoriteRSSFeed() : add or delete the current user list of his rss feed

    public function focusToThisRSSFeed($url) {
        $sql = 'SELECT * FROM FLUX_INFORMATION WHERE IDFLUX IN (SELECT ID FROM FLUX WHERE URL = ?) ORDER BY POSTED DESC';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($url));
        $array = array();
        while($result = $this->pdo->fetch(\PDO::FETCH_ASSOC)) {
            $fluxArt = new FluxArticle($result['TITLE'],$result['POSTED'],$result['CONTENT'],$result['URL'],$result['MD5VERSION']);
            array_push($array,$fluxArt->display());
        }
        return json_encode($array);
    } // focusToThisRSSFeed() : focus the current page user to the rss feed

    public function RSSFeedToDeleteOfACategory($idRSSFeed,$idCategory) {
        $sql = 'DELETE FROM FLUX_ASSOC WHERE IDFLUX= ? AND IDCATE= ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($idRSSFeed,$idCategory));
    } // RSSFeedToDeleteOfACategory() : delete a RSSFeed of a category of current user

    public function addRSSFeedCategoryUser($nameFluxAdd,$nameCategorieToAdd,$urlFluxAdd) {
        $sql = "SELECT ID FROM CATEGORIE WHERE IDUSER = ? AND NAME = ?";
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID'],$nameCategorieToAdd));
        $resultCate = $this->pdo->fetch(\PDO::FETCH_NUM);
        $idCate = $resultCate[0];

        $sql = "SELECT COUNT(*) FROM FLUX WHERE URL = ?";
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($urlFluxAdd));
        $resultVerif = $this->pdo->fetch(\PDO::FETCH_NUM);
        if($resultVerif[0] == 0) {
            $sql = "INSERT INTO FLUX(URL) VALUES(?)";
            $this->pdo->prepare($sql);
            $this->pdo->execute(array($urlFluxAdd));
            $idFlux = $this->pdo->lastInsertId();

            $sql = "INSERT INTO FLUX_ASSOC(IDCATE,IDFLUX,NAME,ISFAVORITE) VALUES(?,?,?,?)";
            $this->pdo->prepare($sql);
            $this->pdo->execute(array($idCate,$idFlux,$nameFluxAdd,0));

            $flux = new FluxUser($idFlux,$urlFluxAdd,$nameFluxAdd,0);
            $flux->refresh();
        } else {
            $sql = "SELECT ID FROM FLUX WHERE URL = ?";
            $this->pdo->prepare($sql);
            $this->pdo->execute(array($urlFluxAdd));
            $resultFlux = $this->pdo->fetch(\PDO::FETCH_NUM);
            $idFlux = $resultFlux[0];

            $sql = "INSERT INTO FLUX_ASSOC(IDCATE,IDFLUX,NAME,ISFAVORITE) VALUES(?,?,?,?)";
            $this->pdo->prepare($sql);
            $this->pdo->execute(array($idCate,$idFlux,$nameFluxAdd,0));
        }
    } // addRSSFeedCategoryUser() : Add a rss feed to a category for current user

    ///////////////////////////////////////////////////////////////////////~RSS////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////CATEGORY//////////////////////////////////////////////////////////////////////


    public function addCategory($categorieToAdd) {
        if(!isset($categorieToAdd[1]))return;
        $sql = "INSERT INTO CATEGORIE (IDUSER,NAME,COLOR) VALUES (?,?,?)";
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID'],$categorieToAdd[0],$categorieToAdd[1]));
    } // addCategory() : add a category for the current user

    public function catToDelete($idCatDelete) {
        $sql = 'DELETE FROM CATEGORIE WHERE ID = ? AND IDUSER = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($idCatDelete,$_SESSION['ID']));
    } // catToDelete() : delete a category of current user

    public function allCategories() {
        $array = array();
        $sql = 'SELECT * FROM FLUX_INFORMATION WHERE IDFLUX IN (SELECT IDFLUX FROM FLUX_ASSOC WHERE IDCATE IN (SELECT ID FROM CATEGORIE WHERE IDUSER= ?)) ORDER BY POSTED DESC';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID']));
        while($result = $this->pdo->fetch(\PDO::FETCH_ASSOC)) {
            $fluxArt = new FluxArticle($result['TITLE'],$result['POSTED'],$result['CONTENT'],$result['URL'],$result['MD5VERSION']);
            array_push($array,$fluxArt->display());
        }
        return json_encode($array);

    } // allCategories() : display all rss feed of a user

    //////////////////////////////////////////////////////////////////////~CATEGORY///////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////FRIEND/////////////////////////////////////////////////////////////////////////
    public function friendBlog($idFriend) {
        $array = array();
        $sql = 'SELECT ARTICLE.*,EMAIL FROM ARTICLE, USERS WHERE IDUSER = ? AND IDUSER = USERS.ID';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($idFriend));
        while ($result = $this->pdo->fetch(\PDO::FETCH_ASSOC)) {
            $article = new Article($result['ID'],$result['TITLE'],$result['THEME'],$result['URL'],$result['CONTENT'],$result['POSTED'],$result['EMAIL']);
            array_push($array, $article->display());
        }
        return json_encode($array);
    } // friendBlog() : display friend blog

    public function deleteOneFriend($idFriend) {
        $sql = 'DELETE FROM FRIEND WHERE IDUSER = ? AND IDFRIEND = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID'],$idFriend));
    } // deleteOneFriend() : delete a friend of current user

    public function userToAddInFriend($idUserToAdd) {
        $sql = 'INSERT INTO FRIEND (IDUSER,IDFRIEND) VALUES(?,?)';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID'],$idUserToAdd));
    } // userToAddInFriend() : add a user in the current user friendlist

    //////////////////////////////////////////////////////////////////////~FRIEND/////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////MAIL////////////////////////////////////////////////////////////////////////
    public function addMail($nameE,$passwordE,$serverE,$portE) {
        $sqlInsertEmail = 'INSERT INTO EMAIL (IDUSER,ADDRESS,PASSWORD) VALUES(?,?,?)';
        $this->pdo->prepare($sqlInsertEmail);
        $this->pdo->execute(array($_SESSION['ID'],$nameE,$passwordE));
        $id = "";
        $sql = 'SELECT * FROM EMAIL';
        $this->pdo->prepare($sql);
        $this->pdo->execute();
        while ($result = $this->pdo->fetch(\PDO::FETCH_ASSOC)) {
            if($result['ADDRESS'] === $nameE) {
                $id = $result['ID'];
            }
        }
        $sqlInsertEmailConnection = 'INSERT INTO EMAIL_CONNECTION (IDMAIL,SERVER,PORT) VALUES (?,?,?)' ;
        $this->pdo->prepare($sqlInsertEmailConnection);
        $this->pdo->execute(array($id,$serverE,$portE));
    } // addMail() : add the mail in database

    public function loadMail($mail) {
        $sql = 'SELECT EMAIL.ID, ADDRESS, PASSWORD, SERVER, PORT FROM EMAIL, EMAIL_CONNECTION WHERE EMAIL.ID = IDMAIL AND IDUSER = ? AND ADDRESS = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($_SESSION['ID'],$mail));
        $array = array();
        while ($result = $this->pdo->fetch(\PDO::FETCH_ASSOC)) {
            $mail = new Email($result['ID'],$result['ADDRESS']);
            $mail->connect($result['SERVER'],$result['PORT'],$result['PASSWORD']);
            $mail->initializeMails();
            foreach($mail->getMails() as $value)  {
                array_push($array, $value->display());
            }
        }
        return json_encode($array);
    } // loadMail() : huge function where it load all mails

    public function deleteMail($mail) {
        $sql = 'DELETE FROM EMAIL WHERE ADDRESS = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($mail));
    } // deleteMail() : delete mail of the mail database

    ////////////////////////////////////////////////////////////////////////~MAIL/////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////TWITTER///////////////////////////////////////////////////////////////////////
    public function searchTwitter($name) {
        $sql = "SELECT COUNT(*) FROM TWITTER WHERE NAME = \"".$name."\"";
        $result = $this->pdo->query($sql)->fetch();
        if($result[0] == 0) {
            $sql = "INSERT INTO TWITTER(NAME) VALUES(\"".$name."\")";
            $this->pdo->query($sql);
            $idTwitter = $this->pdo->lastInsertId();

            $sql = "INSERT INTO TWITTER_ASSOC(IDTWITTER,IDUSER) VALUES(".$idTwitter.",".$_SESSION['ID'].")";
            $this->pdo->query($sql);

            $twitter = new Twitter($idTwitter,$name);
            $twitter->refresh();
        } else {
            $sql = "SELECT ID FROM TWITTER WHERE NAME = \"".$name."\"";
            $result = $this->pdo->query($sql)->fetch();
            $sql = "INSERT INTO TWITTER_ASSOC(IDTWITTER,IDUSER) VALUES(".$result[0].",".$_SESSION['ID'].")";
            $this->pdo->query($sql);
        }
    } // searchTwitter() : search the $name twitter in twitter

    public function loadTwitter($name) {
        $sql = "SELECT * FROM TWITTER WHERE NAME = ?";
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($name));
        $result = $this->pdo->fetch(\PDO::FETCH_ASSOC);

        $twitter = new Twitter($result['ID'],$result['NAME']);
        $twitter->refresh();
        $twitter->initializeTweets();

        $tweets = array();
        foreach($twitter->getTweets() as $tweet) {
            array_push($tweets,$tweet->display());
        }
        return json_encode($tweets);
    } // loadTwitter() : load everything about $nameTwitter

    public function deleteTwitter($name) {
        $sql = 'DELETE FROM TWITTER_ASSOC WHERE IDTWITTER = (SELECT ID FROM TWITTER WHERE NAME = ?) AND IDUSER = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($name,$_SESSION['ID']));
    } // deleteTwitter() : delete $name from twitter database

    ///////////////////////////////////////////////////////////////////////~TWITTER////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////OPTIONS////////////////////////////////////////////////////////////////////////
    public function changeName($name) {
        $sql = 'UPDATE USERS SET NAME ? WHERE ID = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($name,$_SESSION['ID']));
    } // changeName() : change name of current user

    public function changeEmail($email) {
        $sql = 'UPDATE USERS SET EMAIL ? WHERE ID = ?';
        $this->pdo->prepare($sql);
        $this->pdo->execute(array($email,$_SESSION['ID']));
    } // changeEmail() : change email of current user

    ///////////////////////////////////////////////////////////////////////~OPTIONS////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////~FOR A USER//////////////////////////////////////////////////////////////////////

    public function refresh() {

    }

    public function getSpecific () {

    } // getSpecific


}