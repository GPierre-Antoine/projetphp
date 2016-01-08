<?php

include_once('flux.php');

class Categorie 
{

	private $iduser;
	private $name;
	private $color;

	private $flux;

	private $pdo;

	public function __construct($iduser,$name, $color) {
		$this->iduser = $iduser;
		$this->name = $name;
		$this->color = $color;

		$this->flux = array();
		$this->pdo = new \db\db_handler();
	}

	public function initializeInside() {
		$sqlFlux = 'SELECT * FROM FLUX WHERE ID IN (SELECT IDFLUX FROM FLUX_ASSOC WHERE IDUSER = '.$this->iduser.'
																				  AND CATNAME = \''.$this->name.'\')';

		$stmt = $this->pdo->query($sqlFlux);
		while ($flux = $stmt->fetch())
        {
        	$newFlux = build_flux($flux[0]);
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