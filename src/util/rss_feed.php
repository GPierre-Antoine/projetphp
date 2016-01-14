<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 13/01/16
 * Time: 14:57
 */

function rss_feed($url) {
    $rss = new DOMDocument();
    $rss->load($url);
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array (
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        array_push($feed, $item);
    }
    return $feed;
}

function extract_article($feed) {
    $limit = 5;
    $flux_articles = array();
    for($x=0 ; $x <$limit ; $x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $description = $feed[$x]['desc'];
        $date = date('l F d, Y', strtotime($feed[$x]['date']));

        //$flux_article = new FluxArticle();

        array_push($flux_articles,$display);
    }
}

function display_rss($feed) {
    $limit = 5;
    $displays = array();
    for($x=0 ; $x<$limit ; $x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $description = $feed[$x]['desc'];
        $date = date('l F d, Y', strtotime($feed[$x]['date']));

        $display = '
        <div class="article">
            <span class="title">'.$title.'</span>
            <span class="date">Publié le '.$date.'</span>
            <span class="content">'.$description.'</span>
            <span class="redirect"><a href="'.$link.'" target="_blank">Plus d\'information</a></span>
        </div>
        ';

        array_push($displays,$display);
    }

    return $displays;
}