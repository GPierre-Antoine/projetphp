<?php

include_once('Categorie.php');

class User extends ModelPDO
{
    private $id;
    private $email;
	private $name;
    private $enable;

    private $friends;
    private $categories;
    private $articles;

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

    protected function getSpecific()
    {
        // TODO: Implement getSpecific() method.
    }
} // User

function build_user($uid) {
    $db = new \db\db_handler();
    $db = $db->query("SELECT * FROM USERS WHERE ID = " . $uid)->fetch();

    return new User ($db[0],$db[1],$db[2],$db[4]);
}

?>
