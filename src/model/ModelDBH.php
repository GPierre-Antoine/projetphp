<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:19
 */

class ModelDBH extends Model{
    protected $dbh;

    public function __construct(\db\db_handler $dbh) {
        $this->dbh = $dbh;
    }// ModelDBH


}