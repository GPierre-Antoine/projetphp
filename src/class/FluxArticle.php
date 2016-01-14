<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 14/01/16
 * Time: 10:40
 */

class FluxArticle {

    private $id;
    private $title;
    private $date;
    private $content;
    private $url;

    public function __construct($id,$title,$date,$content,$url) {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->content = $content;
        $this->url = $url;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDate() {
        return $this->date;
    }

    public function getContent() {
        return $this->content;
    }

    public function getUrl() {
        return $this->url;
    }


}