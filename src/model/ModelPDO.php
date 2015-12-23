<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:19
 */

include_once('Model.php');
include_once('src/util/db_wrap.php');

class ModelPDO extends Model{
    protected $pdo;

    public function __construct() {
        $this->pdo = new \db\db_handler();
    }


}
