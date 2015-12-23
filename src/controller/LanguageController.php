<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 23:12
 */

include_once('Controller.php');

class IndexController extends Controller {
    public function __construct(Model $model) {
        parent::__construct($model);

    }// ControllerInscription

    public function update() {
        $this->model->setLanguage($_SESSION['lang']);
        $this->model->insert();
    }
}
