<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 22/01/16
 * Time: 10:20
 */

require "src/vendor/twitter_api/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterArticle {

    private $idTwitter;
    private $idTweet;
    private $oembed;

    public function __construct($idTwitter,$idTweet) {
        $this->idTwitter = $idTwitter;
        $this->idTweet = $idTweet;

        $oauth = new TwitterOAuth(\twitter\configuration::$consumerKey, \twitter\configuration::$consumerSecret);
        $accessToken = $oauth->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
        $twitter = new TwitterOAuth(\twitter\configuration::$consumerKey, \twitter\configuration::$consumerSecret, null, $accessToken->access_token);
        $this->oembed = $twitter->get('statuses/oembed', ['id' => $this->idTweet]);
    }

    public function display() {
        return $this->oembed->html;
    }

}