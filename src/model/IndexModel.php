<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 22:53
 */

 include_once('ModelPDO.php');

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

    }

    public function get () {

    }

    public function getSpecific() {

    }

}
