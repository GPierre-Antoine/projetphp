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
        echo'<table>';
      foreach($users as $u) {

          echo'<tr>';
         echo '<td>'.$u->getID() . '</td>';
         echo '<td>'.$u->getEmail() . '</td>';
         echo '<td>'.$u->getName() . '</td>';
         if($u->getEnable() == 1) {
            echo '<td><a id="ena'.$u->getID().'" onclick="enableOrDisableUser(this)" class="myButton">Disable</a></td>';
         }
         else {
          echo '<td><a id="dis'.$u->getID().'" onclick="enableOrDisableUser(this)"  class="myButton" >Enable</a></td>';
         }
         echo '<td><a id="del'.$u->getID().'" onclick="deleteUser(this)" class="myButton"> Delete </a></td>';

          echo'</tr>';
      }

        echo'<table>';
    }

    public function display()
    {
        if ($_SESSION['privilege'] === "ADMIN") {
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
            <button onclick="disconnect()" class="top_deconnection_btn noborder" type="button"></button>
          </div>
          <div id="content">';
            echo $this->affUsers();
            echo '
          </div>
        </body>
      </html>';

        }
        else if($_SESSION['ID'] != null) {
            header('Location:/user');
        }
        else {
            header('Location:/');
        }

}

}
