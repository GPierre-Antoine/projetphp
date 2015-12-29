<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 21:03
 */

include_once('ModelPDO.php');
include_once('src/class/user.php');

class DefaultModel extends ModelPDO {

	private $user;

    public function __construct() {
        parent::__construct();
        $this->user = new User (1);

        //SET FRIENDS OF USER
        /**/
        $friends = array();
        $sqlFriends = "SELECT IDFRIEND FROM FRIEND WHERE IDUSER = ".$this->user->getID();
        $stmt = $this->pdo->query($sqlFriends);
        while ($friend = $stmt->fetch())
        {
        	$sqlInformationFriend = "SELECT * FROM USERS WHERE ID = ".$friend[0];
        	$stmt2 = $this->pdo->query($sqlInformationFriend);
        	$informationFriend = $stmt2->fetch();
        	$newFriend = new User($informationFriend['ID'],$informationFriend['EMAIL'],$informationFriend['NAME']);
        	array_push($friends, $newFriend);
        }
        $this->user->setFriends($friends);
        /* */
    }

    public function getName() {
		return $this->user->getName();
	}

	public function getFriends() {
		return $this->user->getFriends();
	}

	public function getOption() {

	}

	public function getSpecific() {
		
	}
}