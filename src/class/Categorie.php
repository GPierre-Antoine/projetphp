<?php

include_once('FluxUser.php');

class Categorie
{
	private $id;
	private $name;
	private $color;
	private $flux;
	private $pdo;

	public function __construct($id, $name, $color) {
		$this->id = $id;
		$this->name = $name;
		$this->color = $color;
		$this->flux = array();
		$this->pdo = new \db\db_handler();

		$this->initializeFlux();
	}

	private function initializeFlux() {
		$sql = "SELECT * FROM FLUX_ASSOC, FLUX WHERE ID = IDFLUX AND IDCATE = ".$this->id;
		$stmt = $this->pdo->query($sql);
		while($result = $stmt->fetch())
		{
			$newFlux = new FluxUser($result['IDFLUX'],$result['URL'],$result['NAME'],$result['ISFAVORITE']);
			$newFlux->initializeArticles();
			array_push($this->flux, $newFlux);
		}
	}

	public function getFlux() {
		return $this->flux;
	}

	public function getName() {
		return $this->name;
	}

	public function getColor() {
		return $this->color;
	}

	public function getId() {
		return $this->id;
	}
}