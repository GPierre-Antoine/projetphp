<?php
/**
 * Created by Enzo.
 * User: h13002021
 * Date: 29/12/15
 * Time: 14:47
 */

include_once('View.php');

class AdminView extends View {

    public function __construct($model) {
        $this->model = $model;
    }// UserView

    private function affUsers() {
      $users = $this->model->getUsers();
      foreach($users as $u) {
         echo '<div class="user"><div class="user_Content">';
         echo $u->getID() . '<br/>';
         echo $u->getEmail() . '<br/>';
         echo $u->getName() . '<br/>';
         echo '</div><div class="user_Footer">';
         if($u->getEnable() == 1) {
            echo '<a href="#" id="' . $u->getID() . '"onclick="javascript:;" class="myButton">Enable</a>';
         }
         else {
          echo '<a  onclick="javascript:;"  class="myButton" >Disable</a>';
         }
         echo '<a  class="myButton"> Delete </a></div></div>';
      }
    }

    public function display() {
      echo '
        <html>
        <head>
          <title>Admin</title>
          <link rel="stylesheet" type="text/css" href="/src/style/admin.css" />
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
          <script type="text/javascript" src="/src/js/admin.js"></script>
        </head>
        <body>
          <!-- TOP SIDE -->
          <div id="top">
            <img class="logo" src="/src/images/aaron_logo.png">
            <div id="TUser"><div id="TUserName"><strong> Panel Admin </strong></div></div>
          </div>
          <div id="content">';
      echo $this->affUsers();
          echo '
          </div>
        </body>
      </html>';

        }

}
