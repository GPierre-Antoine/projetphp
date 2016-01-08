<?php
/**
 * Created by PhpStorm.
 * User: Pierre-Antoine
 * Date: 28/12/2015
 * Time: 16:46
 */

 include_once("View.php");

 class LoginView extends View {

     public function __construct($model) {
         $this->model = $model;
     }// ViewIndex

     public function display() {
         if($_SESSION['logged'] == true) {

         }
         else {

         }
     }// render
 }
