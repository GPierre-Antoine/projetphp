<?php

include_once('Flux.php');

class Categorie 
{

	private $name;
	private $color;
	private $flux;
	private $pdo;

	public function __construct($name, $color) {
		$this->name = $name;
		$this->color = $color;

		$this->flux = array();
		$this->pdo = new \db\db_handler();
	}

	public function initializeInside() {
		$sqlFlux = 'SELECT * FROM FLUX WHERE ID IN (SELECT IDFLUX FROM FLUX_ASSOC WHERE IDUSER = 3
																				  AND CATNAME = \''.$this->name.'\')';

		$stmt = $this->pdo->query($sqlFlux);
		while ($flux = $stmt->fetch())
        {
			$newFlux = new Flux($flux[0],$flux[1],$flux[2],$flux[3]);
            $newFlux->rss_feed();
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