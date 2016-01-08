<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 08/01/16
 * Time: 16:36
 */

include_once('View.php');

class SettingsView extends View {

    public function __construct($model) {
        $this->model = $model;
    }

    public function display() {
        echo '

        ';
    }
}