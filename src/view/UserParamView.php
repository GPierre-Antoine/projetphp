<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 21/12/15
 * Time: 21:01
 */

include_once("View.php");

class UserParamView extends View {

    public function __construct($model) {
        $this->model = $model;
    }// ViewIndex

    public function display() {
        echo 'Tu es un user comme un autre, n\'en fait pas tout un plat';
    }// render
}
