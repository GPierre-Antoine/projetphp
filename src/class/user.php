<?php

include_once('categorie.php');

class User
{
    private $id;
    private $email;
	private $name;
    private $enable;

    private $friends;
    private $categories;
    private $favorites;

    private $pdo;

	public function __construct($id,$email,$name,$enable) {
		$this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->enable = $enable;
        $this->pdo = new \db\db_handler();
	}

    public function initializeFriends() {
         //GET FRIENDS OF USER
        $this->friends = array();
        /*$sqlFriends = "SELECT IDFRIEND FROM FRIEND WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sqlFriends);
        while ($friend = $stmt->fetch())
        {
            $sqlInformationFriend = "SELECT * FROM USERS WHERE ID = ".$friend[0];
            $stmt2 = $this->pdo->query($sqlInformationFriend);
            $informationFriend = $stmt2->fetch();
            $newFriend = build_user ($informationFriend['ID']);
            array_push($this->friends, $newFriend);
        }*/

        $sqlFriends = "SELECT IDFRIEND FROM FRIEND WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sqlFriends);
        while ($friend = $stmt->fetch())
        {
            $newFriend = build_user ($friend['IDFRIEND']);
            array_push($this->friends, $newFriend);
        }
    }

    public function initializeCategories() {
        //GET CATEGORIES OF USER
        $this->categories = array();
        $sqlCategories = "SELECT * FROM CATEGORIE WHERE IDUSER = ".$this->id;
        $stmt = $this->pdo->query($sqlCategories);
        while ($categorie = $stmt->fetch())
        {
            $newCategorie = new categorie($this->id,$categorie['NAME'],$categorie['COLOR']);
            array_push($this->categories, $newCategorie);
        }
    }

    public function initializeFlux() {
        foreach($this->categories as $cat) {
            $cat->initializeInside();
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

} // User

function build_user($uid) {
    $db = new \db\db_handler();
    $db = $db->query("SELECT * FROM USERS WHERE ID = " . $uid)->fetch();


    return new User ($db[0],$db[1],$db[2],$db[4]);
}

?>
