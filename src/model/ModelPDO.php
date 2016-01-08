<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:19
 */

include_once('Model.php');
include_once('src/util/db_wrap.php');

abstract class ModelPDO extends Model{
    protected $pdo;

    protected $table;

    protected $request = "SELECT * FROM ";
    private $option;
    protected $spec;
    protected $query;
    protected $reupdate = true;

    protected $data;

    public function RowCount () {
        return $this->pdo->rowCount();
    }

    public function __construct() {
        $this->pdo = new \db\db_handler();
    }

    protected function change_option($newOption) {
        $this->option = $newOption;
        $this->reupdate = true;
    }

    protected function getOption() {
        return $this->option;
    }

    protected abstract function getSpecific();

    public function update () {
        if ($this->reupdate === true) {

            $final = $this->request . $this->table . PHP_EOL . $this->getSpecific() . $this->getOption();
            $this->pdo->prepare($final);
            $this->reupdate = false;
        }
        $this->pdo->execute($this->spec);
    }

    public function getData($field) {
        return $this->query[$field];
    }

    public function next() {
        $this->query = ($this->pdo->fetch(PDO::FETCH_ASSOC));
        if ($this->query === false)
            return false;
        return true;
    }

    public function insert () {

    }


}
