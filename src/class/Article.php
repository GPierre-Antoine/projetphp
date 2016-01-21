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
    private $date;
    private $source;

    public function __construct($id, $title, $theme, $imgUrl, $content, $date, $source) {
        $this->id = $id;
        $this->title = $title;
        $this->theme = $theme;
        $this->imgUrl = $imgUrl;
        $this->content = $content;
        $this->date = $date;
        $this->source = $source;
    }

    public function display() {
        $display = '
            <div class="article" >
                <div class="article_zone_img" >
                    <img class="article_img" src = "'.$this->imgUrl.'" />
                </div >
                <div class="article_zone_content" >
                    <span class="article_content_inf"><span class="article_inf_title">'.$this->title.'</span> dans <span class="article_inf_theme">'.$this->theme.'</span></span><span class="article_inf_date">le '.$this->date.'</span><br/>
                    <span class="article_content_source">Par : '.$this->source.'</span>
                    <p class="article_content">'.$this->content.'</p>
                </div>
            </div>
        ';
        return $display;
    }

}