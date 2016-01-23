<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 22/01/16
 * Time: 09:33
 */

require "src/vendor/twitter_api/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter {

    private $id;
    private $name;
    private $twitter;
    private $articles;
    private $pdo;

    public function __construct($id,$name) {
        $this->id = $id;
        $this->name = $name;
        $this->pdo = new \db\db_handler();
    }

    public function refresh() {
        $oauth = new TwitterOAuth(\twitter\configuration::$consumerKey, \twitter\configuration::$consumerSecret);
        $accessToken = $oauth->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
        $this->twitter = new TwitterOAuth(\twitter\configuration::$consumerKey, \twitter\configuration::$consumerSecret, null, $accessToken->access_token);
        $this->update();
    }

    private function update() {
        $tweets = $this->twitter->get('statuses/user_timeline', ['screen_name' => $this->name,
            'exclude_replies' => true,
            'include_rts' => false,
            'count' => 15 ]);
        foreach($tweets as $tweet) {
            $tweetId = $tweet->id;
            $oembed = $this->twitter->get('statuses/oembed', ['id' => $tweetId, 'omit_script' => true]);
            $html = $oembed->html;
            $version = md5($html);

            $this->pdo->prepare("SELECT COUNT(*) FROM TWEET WHERE VERSION = ?");
            $this->pdo->execute(array($version));
            $result = $this->pdo->fetch(\PDO::FETCH_NUM);
            if($result[0] == 0) {
                $this->pdo->prepare("INSERT INTO TWEET(IDTWITTER,IDTWEET,DISPLAY,VERSION) VALUES(?,?,?,?)");
                $this->pdo->execute(array($this->id,$tweetId,$html,$version));
            }
        }
    }

    public function initializeTweets() {
        $this->articles = array();
        $this->pdo->prepare("SELECT * FROM TWEET WHERE IDTWITTER = ?");
        $this->pdo->execute(array($this->id));
        while($result = $this->pdo->fetch(\PDO::FETCH_ASSOC))
        {
            $tweet = new TwitterArticle($result['IDTWITTER'],$result['IDTWEET'],$result['DISPLAY'],$result['VERSION']);
            array_push($this->articles,$tweet);
        }
    }

    public function getTweets() {
        return array_slice($this->articles,0,10);
    }

    public function getName() {
        return $this->name;
    }

}