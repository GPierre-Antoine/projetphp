<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 10/01/2016
 * Time: 21:11
 */
class Article
{

    private $id;
    private $content;

    public function __construct($id, $content) {
        $this->id = $id;
        $this->content = $content;
    }

}