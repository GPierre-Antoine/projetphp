<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 22/01/16
 * Time: 09:33
 */

require "src/vendor/twitter_api/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
//require_once ('/home/aaron-aaron/www/src/util/db/sql_access.php');

class Twitter {

    private $id;
    private $iduser;
    private $name;
    private $twitter;
    private $articles;
    private $pdo;

    public function __construct($id,$iduser,$name) {
        $this->id = $id;
        $this->iduser = $iduser;
        $this->name = $name;
        $this->pdo = new \db\db_handler();
    }

    public function refresh() {
        $oauth = new TwitterOAuth(\twitter\configuration::$consumerKey, \twitter\configuration::$consumerSecret);
        $accessToken = $oauth->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
        $this->twitter = new TwitterOAuth(\twitter\configuration::$consumerKey, \twitter\configuration::$consumerSecret, null, $accessToken->access_token);
        $this->initializeTweets();
    }

    private function initializeTweets() {
        $this->articles = array();
        $tweets = $this->twitter->get('statuses/user_timeline', ['screen_name' => $this->name,
            'exclude_replies' => true,
            'count' => 50 ]);
        foreach($tweets as $tweet) {
            $this->pdo->prepare("INSERT INTO TWITTER_FLUX(IDTWITTER,MESSAGE,POSTED) VALUES(?,?,?)");
            $this->pdo->execute(array($this->id,$tweet->text,0));

            $newTweet = new TwitterArticle($this->id,$tweet->text,$this->name);
            array_push($this->articles,$newTweet);
        }
    }

    /*public function initializeTweets() {
        $this->articles = array();
        $this->pdo->prepare("SELECT * FROM TWITTER_FLUX WHERE IDTWITTER = ?");
        $this->pdo->execute(array($this->id));
        while($result = $this->pdo->fetch(\PDO::FETCH_ASSOC))
        {
            $tweet = new TwitterArticle($result['ID'],$result['MESSAGE']);
            array_push($this->articles,$tweet);
        }
    }*/

    public function getTweets() {
        return $this->articles;
    }

}