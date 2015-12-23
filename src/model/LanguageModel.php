<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 23:07
 */

 include_once('ModelPDO.php');

class LanguageModel extends ModelPDO {
    private $data;
    private $lang;

    public function __construct() {
        parent::__construct();
    }

    public function insert() {
        $stmt = $this->pdo->query('SELECT * FROM LANG WHERE LANG = \'' . $this->lang . '\'');
        $this->data = $stmt->fetch(PDO::FETCH_NUM);
    }

    public function setLanguage($lang) {
      $this->lang = $lang;
    }

    public function getData() {
        return $this->data;
    }


}
