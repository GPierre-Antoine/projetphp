<?php
/**
 * Created by PhpStorm.
 * User: g13003750
 * Date: 16/12/15
 * Time: 16:45
 */

include_once("View.php");

class ViewIndex extends View {
    private $model;

    public function __construct(ModelUnknowUser $mUU) {
        $this->model = $mUU;
    }// ViewIndex

    public function display() {
        //script à kevin
    }// render
}