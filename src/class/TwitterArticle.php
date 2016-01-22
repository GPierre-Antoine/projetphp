<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 22/01/16
 * Time: 10:20
 */

class TwitterArticle {

    private $id;
    private $from;
    private $body;
    private $img;
    private $date;
    private $version;

    public function __construct($id,$from,$body,$img,$date,$version) {
        $this->id = $id;
        $this->from = $from;
        $this->body = $body;
        $this->img = $img;
        $this->date = $date;
        $this->version = $version;
    }

    public function getVersion() {
        return $this->version;
    }

    public function display() {
        $display = '
        <article>
            <aside class="avatar">
                <a href="http://twitter.com/'.$this->from.'" target="_blank">
                    <img alt="'.$this->from.'" src="'.$this->img.'" />
                </a>
            </aside>
            <p>'.$this->date.'</p>
            <p>'.$this->body.'</p>
        </article>
        ';
        return $display;
    }

}