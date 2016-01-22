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
    private $twitters;

	public function __construct($id,$email,$name,$enable) {
		$this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->enable = $enable;
        $this->pdo = new \db\db_handler();

        $this->updateFollow();
        $this->updateAvatar();
	}

    public function initializeFriends() {
        $this->friends = array();
        $sql = "SELECT IDFRIEND FROM FRIEND WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sql);
        while ($friend = $stmt->fetch())
        {
            $newFriend = build_user ($friend['IDFRIEND']);
            $newFriend->initializeArticles();
            array_push($this->friends, $newFriend);
        }
    }

    public function initializeCategories() {
        $this->categories = array();
        $sql = "SELECT * FROM CATEGORIE WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sql);
        while ($categorie = $stmt->fetch())
        {
            $newCategorie = new categorie($categorie['ID'], $categorie['NAME'], $categorie['COLOR']);
            array_push($this->categories, $newCategorie);
        }
    }

    public function initializeArticles() {
        $this->articles = array();
        $sqlArticles = "SELECT * FROM ARTICLE WHERE IDUSER = ".$this->id." ORDER BY POSTED DESC";
        $stmt = $this->pdo->query($sqlArticles);
        while ($categorie = $stmt->fetch())
        {
            $newArticle = new Article($categorie[0],$categorie[2],$categorie[3],$categorie[4],$categorie[5],$categorie[6],$this->email);
            array_push($this->articles,$newArticle);
        }
    }

    public function initializeMailBox() {
        $this->mailbox = array();
        $sql = "SELECT ID, ADDRESS FROM EMAIL WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sql);
        while($result = $stmt->fetch())
        {
            $newBox = new Email($result[0],$result[1]);
            array_push($this->mailbox,$newBox);
        }
    }

    public function initializeTwitter() {
        $this->twitters = array();
        $this->pdo->prepare("SELECT NAME FROM TWITTER WHERE ID = (SELECT IDTWITTER FROM TWITTER_ASSOC WHERE IDUSER = ?)");
        $this->pdo->execute(array($this->id));
        while($result = $this->pdo->fetch(\PDO::FETCH_ASSOC))
        {
            array_push($this->twitters,$result['NAME']);
        }
    }

    private function updateFollow() {
        $sqlFollows = "SELECT count(*) FROM FRIEND WHERE IDUSER = ".$this->id;
        $sqlFollowers = "SELECT count(*) FROM FRIEND WHERE IDFRIEND = ".$this->id;
        $resultFollows = $this->pdo->query($sqlFollows)->fetch();
        $resultFollowers = $this->pdo->query($sqlFollowers)->fetch();
        $this->follows = $resultFollows[0];
        $this->followers = $resultFollowers[0];
    }

    private function updateAvatar() {
        $sql = "SELECT AVATAR FROM USER_INFORMATION WHERE ID = ".$this->id;
        $result = $this->pdo->query($sql)->fetch();
        $this->avatar = $result[0];
    }

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

    public function getMailBox() {
        return $this->mailbox;
    }

    public function getTwitters() {
        return $this->twitters;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getNbFollows() {
        return $this->follows;
    }

    public function getNbFollowers() {
        return $this->followers;
    }

    protected function getSpecific() {
        // TODO: Implement getSpecific() method.
    }

} // User

function build_user($uid) {
    $db = new \db\db_handler();
    $db = $db->query("SELECT * FROM USERS WHERE ID = " . $uid)->fetch();
    return new User ($db[0],$db[1],$db[2],$db[3]);
}
