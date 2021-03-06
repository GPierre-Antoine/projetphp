<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 21:03
 */

include_once('ModelPDO.php');
include_once('src/class/User.php');

class DefaultModel extends ModelPDO {

	private $user;

    public function __construct() {
        parent::__construct();
        if($_SESSION['ID'] == null) {
            header('Location:/');
        }
        else if($_SESSION['admin'] == "admin") {
            header('Location:/admin');
        }
        else {
            $this->user = build_user($_SESSION['ID']);
            $this->user->initializeFriends();
            $this->user->initializeCategories();
            $this->user->initializeFlux();
            $this->user->initializeArticles();
            $this->user->initializeMailBox();
            $this->user->initializeTwitter();
        }
    }

    public function getUser() {
        return $this->user;
    }

	public function getOption() {

	}

	public function getSpecific() {
		
	}
}