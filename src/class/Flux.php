<?php

class Flux
{
	private $id;
	private $name;
	private $url;
	private $isFavorite;

	public function __construct($id,$name,$url,$isFavorite) {
		$this->id = $id;
		$this->name = $name;
		$this->url = $url;
		$this->isFavorite = $isFavorite;
	}

	public function getName() {
		return $this->name;
	}

	public function getUrl() {
		return $this->url;
	}

	public function isFavorite() {
		return $this->isFavorite;
	}

}