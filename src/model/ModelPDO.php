<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 17:19
 */

class ModelPDO extends Model{
    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


}