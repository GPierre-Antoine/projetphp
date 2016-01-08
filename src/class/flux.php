<?php

class Flux
{
	
	private $name;
	private $url;
	private $isFavorite;

	public function __construct($name,$url,$isFavorite) {
		$this->name = $name;
		$this->url = $url;
		$this->isFavorite = $isFavorite;
	}

	public function getName() {
		return $this->name;
	}

	public function isFavorite() {
		return $this->isFavorite;
	}

}

function build_flux($uid) {
    $db = new \db\db_handler();
    $db = $db->query("SELECT NAME,URL,ISFAVORITE FROM FLUX WHERE ID = " . $uid)->fetch();

    return new Flux($db[0],$db[1],$db[2]);
}