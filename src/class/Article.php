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
    private $title;
    private $theme;
    private $imgUrl;
    private $content;

    public function __construct($id, $title, $theme, $imgUrl, $content) {
        $this->id = $id;
        $this->title = $title;
        $this->theme = $theme;
        $this->imgUrl = $imgUrl;
        $this->content = $content;
    }

}