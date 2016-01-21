<?php

class Flux
{
    protected $id;
    protected $url;
    protected $feed;
    protected $fluxArticles;
    protected $pdo;

	public function __construct($id,$url) {
		$this->id = $id;
		$this->url = $url;
        $this->fluxArticles = array();
        $this->feed = array();
        $this->pdo = new \db\db_handler();
	}

	public function getId() {
		return $this->id;
	}

	public function getUrl() {
		return $this->url;
	}

    public function getFluxArticles() {
        return $this->fluxArticles;
    }

    public function rss_feed() {
        $rss = new DOMDocument();
        $rss->load($this->url);
        foreach ($rss->getElementsByTagName('item') as $node) {
            $item = array (
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
            );
            array_push($this->feed, $item);
        }

        $this->extract_article();
    }

    private function extract_article() {
        for($x = 0 ; $x < count($this->feed) ; $x++) {
            $title = str_replace(' & ', ' &amp; ', $this->feed[$x]['title']);
            $link = $this->feed[$x]['link'];
            $description = $this->feed[$x]['desc'];
            $date = date('Y-m-d H:i:s',strtotime($this->feed[$x]["date"]));
            $key = md5($title.$link.$description.$date);

            $flux_article = new FluxArticle($title,$date,$description,$link,$key);
            array_push($this->fluxArticles,$flux_article);
        }
    }

    public function refresh() {
        $this->rss_feed();

        foreach($this->fluxArticles as $artFl) {
            $verif = "SELECT count(*) FROM FLUX_INFORMATION WHERE MD5VERSION = '".$artFl->getKey()."'";
            $stmtVerif = $this->pdo->query($verif);
            $resultVerif = $stmtVerif->fetch();
            if($resultVerif[0] == 0) {
                $this->pdo->prepare("INSERT INTO FLUX_INFORMATION(IDFLUX,TITLE,POSTED,CONTENT,URL,MD5VERSION) VALUES (?,?,?,?,?,?)");
                $this->pdo->execute(array($this->id,$artFl->getTitle(),$artFl->getDate(),$artFl->getContent(),$artFl->getUrl(),$artFl->getKey()));
            }
        }

    }
}