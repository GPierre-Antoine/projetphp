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

    public function __construct($idTwitter,$idTweet,$html) {
        $this->idTwitter = $idTwitter;
        $this->idTweet = $idTweet;
        $this->html = $html;
    }

    public function display() {
        return $this->html;
    }

}