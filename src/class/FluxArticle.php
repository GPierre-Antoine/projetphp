<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 14/01/16
 * Time: 10:40
 */

class FluxArticle {

    private $title;
    private $date;
    private $content;
    private $url;

    private $key;

    public function __construct($title,$date,$content,$url,$key) {
        $this->title = $title;
        $this->date = $date;
        $this->content = $content;
        $this->url = $url;
        $this->key = $key;
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

    public function getKey() {
        return $this->key;
    }

    function display() {
        $display = '
            <div class="article">
                <span class="title">'.$this->title.'</span>
                <span class="date">Publié le '.$this->date.'</span>
                <span class="content">'.$this->content.'</span>
                <span class="redirect"><a href="'.$this->url.'" target="_blank">Plus d\'information</a></span>
            </div>';

        return $display;
    }

}