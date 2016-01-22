<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 22/01/16
 * Time: 10:20
 */

class TwitterArticle {

    private $idTweeter;
    private $idTweet;
    private $html;

    public function __construct($idTweeter,$idTweet,$html) {
        $this->idTweeter = $idTweeter;
        $this->idTweet = $idTweet;
        $this->html = $html;
    }

    public function display() {
        return $this->html;
    }

}