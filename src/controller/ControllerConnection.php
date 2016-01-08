<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 17/12/15
 * Time: 16:51
 */
$base = $_SERVER['DOCUMENT_ROOT']."src/";

include_once($base .'controller/Controller.php');
class ControllerConnection extends Controller {
    public function __construct(Model $model) {
        parent::__construct($model);
    }// ControllerConnection

    public function update($information1,$information2) {
        $this->model->get($information1,$information2);
    }// update
}