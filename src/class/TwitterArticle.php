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
    private $date;

    private $version;

    public function __construct($id,$body,$source,$date,$version) {
        $this->id = $id;
        $this->body = $body;
        $this->source = $source;
        $this->date = $date;
        $this->version = $version;
    }

    public function getVersion() {
        return $this->version;
    }

    public function display() {
        return $this->body.' par : '.$this->source;
    }

}