<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 22/01/16
 * Time: 10:20
 */

class TwitterArticle {

    private $idTwitter;
    private $idTweet;
    private $html;
    private $date;
    private $version;

    public function __construct($idTwitter,$idTweet,$html,$date,$version) {
        $this->idTwitter = $idTwitter;
        $this->idTweet = $idTweet;
        $this->html = $html;
        $this->date = $date;
        $this->version = $version;
    }

    public function display() {
        return $this->html;
    }

    public function getVersion() {
        return $this->version;
    }

}