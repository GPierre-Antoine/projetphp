<?php

class Flux
{
	private $id;
	private $name;
	private $url;
	private $isFavorite;

    private $feed;
    private $fluxArticles;

	public function __construct($id,$name,$url,$isFavorite) {
		$this->id = $id;
		$this->name = $name;
		$this->url = $url;
		$this->isFavorite = $isFavorite;

        $this->fluxArticles = array();
        $this->feed = array();
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getUrl() {
		return $this->url;
	}

    public function getFluxArticles() {
        return $this->fluxArticles;
    }

	public function isFavorite() {
		return $this->isFavorite;
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
    }

    public function extract_article() {
        for($x = 0 ; $x < count($this->feed) ; $x++) {
            $title = str_replace(' & ', ' &amp; ', $this->feed[$x]['title']);
            $link = $this->feed[$x]['link'];
            $description = $this->feed[$x]['desc'];
            $date = date('l F d, Y', strtotime($this->feed[$x]['date']));

            $key = md5($title.$link.$description.$date);
            $flux_article = new FluxArticle($title,$date,$description,$link,$key);

            array_push($this->fluxArticles,$flux_article);
        }
    }

    public function refresh() {
        $this->rss_feed();
        $this->extract_article();
        $db = new \db\db_handler();

        foreach($this->fluxArticles as $artFl) {

            $verif = 'SELECT count(*) FROM FLUX_INFORMATION WHERE URL = \''.$artFl->getUrl().'\'';
            $stmtVerif = $db->query($verif);
            $resultVerif = $stmtVerif->fetch();
            if($resultVerif[0] == 0) {
                $sql = 'INSERT INTO FLUX_INFORMATION(IDFLUX,TITLE,POSTED,CONTENT,URL,MD5VERSION)
                        VALUES ('.$this->id.',\''.$artFl->getTitle().'\',\''.$artFl->getDate().'\',\''.$artFl->getContent().'\',\''.$artFl->getUrl().'\',\''.$artFl->getKey().'\')';
                $stmtInsert = $db->query($sql);
            }
        }


    }

}