<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 16/01/2016
 * Time: 11:39
 */
class FluxUser extends Flux
{
    private $name;
    private $isFavorite;

    public function __construct($id,$name,$url,$isFavorite) {
        parent::__construct($id,$url);
        $this->name = $name;
        $this->isFavorite = $isFavorite;
    }

    public function initializeArticlesFlux() {
        $sql = 'SELECT * FROM FLUX_INFORMATION WHERE IDFLUX = '. $this->id;
        $stmt = $this->pdo->query($sql);
        while($result = $stmt->fetch())
        {
            $fluxArt = new FluxArticle($result['TITLE'],$result['POSTED'],$result['CONTENT'],$result['URL'],$result['MD5VERSION']);
            array_push($this->fluxArticles,$fluxArt);
        }
    }

    public function getName() {
        return $this->name;
    }

    public function isFavorite() {
        return $this->isFavorite;
    }
}