<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 22/01/16
 * Time: 10:20
 */

class TwitterArticle {

    private $id;
    private $body;
    private $source;

    public function __construct($id,$body,$source) {
        $this->id = $id;
        $this->body = $body;
        $this->source = $source;
    }

    public function display() {
        return $this->body.' par : '.$this->source;
    }

}