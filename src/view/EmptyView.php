<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 08/01/16
 * Time: 16:35
 */

class EmptyView extends View {

    public function __construct($model) {
        $this->model = $model;
    }// UserView

    public function display() {
        if(isset($_POST['addArticle'])) {
            //$this->model->addArticle($_POST['addArticle']);
            echo "fine";
        }
    }

}