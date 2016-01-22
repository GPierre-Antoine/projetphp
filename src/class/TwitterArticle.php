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

    public function __construct($id,$body) {
        $this->id = $id;
        $this->body = $body;
    }

    public function display() {
        return $this->body;
    }

}