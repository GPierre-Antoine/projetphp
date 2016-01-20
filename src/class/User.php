<?php

include_once('Categorie.php');

class User extends ModelPDO
{
    private $id;
    private $email;
	private $name;
    private $enable;
    private $avatar;
    private $follows;
    private $followers;

    private $friends;
    private $categories;
    private $articles;
    private $mailbox;

	public function __construct($id,$email,$name,$enable) {
		$this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->enable = $enable;
        $this->pdo = new \db\db_handler();
	}

    public function initializeFriends() {
        $this->friends = array();

        $sqlFriends = "SELECT IDFRIEND FROM FRIEND WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sqlFriends);
        while ($friend = $stmt->fetch())
        {
            $newFriend = build_user ($friend['IDFRIEND']);
            array_push($this->friends, $newFriend);
        }
    }

    public function initializeCategories() {
        $this->categories = array();
        $sqlCategories = "SELECT * FROM CATEGORIE WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sqlCategories);
        while ($categorie = $stmt->fetch())
        {
            $newCategorie = new categorie($categorie['ID'], $categorie['NAME'], $categorie['COLOR']);
            array_push($this->categories, $newCategorie);
        }
    }

    public function initializeFlux() {
        foreach($this->categories as $cat) {
            $cat->initializeInside();
        }
    }

    public function initializeArticles() {
        $this->articles = array();
        $sqlArticles = "SELECT * FROM ARTICLE WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sqlArticles);
        while ($categorie = $stmt->fetch())
        {
            $newArticle = new Article($categorie[0],$categorie[2],$categorie[3],$categorie[4],$categorie[5]);
            array_push($this->articles,$newArticle);
        }
    }

    public function initializeMailBox() {
        $this->mailbox = array();
        $sql = "SELECT * FROM EMAIL, EMAIL_CONNECTION WHERE EMAIL.ID = IDMAIL AND IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sql);
        while ($result = $stmt->fetch())
        {
            $mailB = new Email($result['ID'],$result['ADDRESS'],$result['PASSWORD']);
            $mailB->setServer($result['SERVER'],$result['PORT']);
            $mailB->refresh();
            $mailB->initializeMailsInside();
            array_push($this->mailbox,$mailB);
        }
    }

    /*public function initializeMails() {
        $this->mailbox = array();
        $sql = "SELECT * FROM EMAIL, EMAIL_CONNECTION WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sql);
        while ($result = $stmt->fetch())
        {
            $mail = new Email($result['ID'],$result['ADDRESS'],$result['PASSWORD'],$result['SERVER'],$result['PORT']);
            $mail->connect();
            $mail->read();
            array_push($this->mailbox,$mail);
        }
    }*/

	//GETTERS
	public function getID() {
		return $this->id;
	}

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getEnable() {
      return $this->enable;
    }

    public function getFriends() {
        return $this->friends;
    }

    public function getCategories() {
        return $this->categories;
    }

    public function getArticles() {
        return $this->articles;
    }

    public function getEmailBox() {
        return $this->mailbox;
    }

    protected function getSpecific()
    {
        // TODO: Implement getSpecific() method.
    }

    public function getAvatar() {
        $sql = "SELECT AVATAR FROM USER_INFORMATION WHERE ID = ".$this->id;
        $result = $this->pdo->query($sql)->fetch();
        $this->avatar = $result[0];
        return $this->avatar;
    }

    public function getNbFollows() {
        return $this->follows;
    }

    public function getNbFollowers() {
        return $this->followers;
    }

    public function setAvatar($avatar) {
        if (isImageURL($avatar)) {
            $this->avatar = $avatar;
            $sql = "UPDATE USER_INFORMATION SET AVATAR = \"" . $this->avatar . "\" WHERE ID = ".$this->id;
            $this->pdo->query($sql);
        } else {
            //To do error
        }
    }

    public function updateFollow() {
        $sqlFollows = "SELECT count(*) FROM FRIEND WHERE IDUSER = ".$this->id;
        $sqlFollowers = "SELECT count(*) FROM FRIEND WHERE IDFRIEND = ".$this->id;
        $resultFollows = $this->pdo->query($sqlFollows)->fetch();
        $resultFollowers = $this->pdo->query($sqlFollowers)->fetch();
        $this->follows = $resultFollows[0];
        $this->followers = $resultFollowers[0];
    }
} // User

function build_user($uid) {
    $db = new \db\db_handler();
    $db = $db->query("SELECT * FROM USERS WHERE ID = " . $uid)->fetch();

    return new User ($db[0],$db[1],$db[2],$db[4]);
}

?>
