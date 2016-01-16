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
	}

	public function initializeInside() {
		$sql = "SELECT * FROM FLUX_ASSOC WHERE IDCATE = ".$this->id;
		$stmtFA = $this->pdo->query($sql);
		while($resultFA = $stmtFA->fetch())
		{
			$idFlux = $resultFA['IDFLUX'];
			$fluxName = $resultFA['NAME'];
			$isFav = $resultFA['ISFAVORITE'];
			$sql = "SELECT URL FROM FLUX WHERE ID = ".$idFlux;
			$resultF = $this->pdo->query($sql)->fetch();
			$newFlux = new FluxUser($idFlux,$fluxName,$resultF['URL'],$isFav);
			$newFlux->initializeArticlesFlux();
			array_push($this->flux, $newFlux);
		}
	}

	public function setFlux($flux) {
		$this->flux = $flux;
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
}