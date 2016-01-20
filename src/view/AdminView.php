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
         echo '<div id="user'.$u->getID().'" class="user"><div class="user_Content">';
         echo $u->getID() . '<br/>';
         echo $u->getEmail() . '<br/>';
         echo $u->getName() . '<br/>';
         echo '</div><div id="user_Footer'.$u->getID() . '" class="user_Footer">';
          echo 'test ici : '+$u->getEnable();
         if($u->getEnable() == 1) {
            echo '<a id="ena'.$u->getID().'" onclick="enableOrDisableUser(this)" class="myButton">Disable</a>';
         }
         else {
          echo '<a id="dis'.$u->getID().'" onclick="enableOrDisableUser(this)"  class="myButton" >Enable</a>';
         }
         echo '<a id="del'.$u->getID().'" onclick="deleteUser(this)" class="myButton"> Delete </a></div></div>';
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
          <script type="text/javascript" src="/src/js/ajaxAdmin.js"></script>
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
