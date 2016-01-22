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
            $date = date('Y-m-d H:i:s',strtotime($tweet->created_at));
            $text = $tweet->text;
            $version = md5($text);

            $newTweet = new TwitterArticle($this->id,$text,$this->name,$date,$version);
            array_push($this->articles,$newTweet);

            $this->pdo->prepare("SELECT COUNT(*) FROM TWITTER_FLUX WHERE IDTWITTER = ? AND CHECKVERSION = ?");
            $this->pdo->execute(array($this->id,$newTweet->getVersion()));
            $result = $this->pdo->fetch(\PDO::FETCH_NUM);
            if($result[0] == 0) {
                $this->pdo->prepare("INSERT INTO TWITTER_FLUX(IDTWITTER,MESSAGE,POSTED,CHECKVERSION) VALUES(?,?,?,?)");
                $this->pdo->execute(array($this->id,$text,$date,$version));
            }
        }
    }

    public function getTweets() {
        return $this->articles;
    }

}