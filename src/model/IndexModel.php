<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 22:53
 */

 include_once('ModelPDO.php');
 include_once('LanguageModel.php');

class IndexModel extends ModelPDO {
    public $inscription;
    public $connection;
    public $firstName;
    public $name;
    public $password;
    public $repassword;
    public $email;
    public $submitation;

    public function __construct() {
        parent::__construct();
    }

    public function insert() {
        $lm = new LanguageModel;
        $lm->setLanguage($_SESSION['lang']);
        $lm->insert();
        $result = $lm->getData();
        $this->inscription = $result[1];
        $this->connection = $result[2];
        $this->firstName = $result[3];
        $this->name = $result[4];
        $this->password = $result[5];
        $this->repassword = $result[6];
        $this->email = $result[7];
        $this->submitation = $result[8];

    }

}
