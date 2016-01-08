<?php
/**
 * Created by Enzo.
 * User: g13003750
 * Date: 29/12/15
 * Time: 14:46
 */

 include_once('ModelPDO.php');
 include_once('src/class/User.php');

class AdminModel extends ModelPDO {

    private $users;

    public function __construct() {
        parent::__construct();
        $this->users = array();
        $sql = 'SELECT * FROM USERS';
        $stmt = $this->pdo->query($sql);
        while ($rep = $stmt->fetch())
        {
          $user = build_user ($rep['ID']);
          array_push($this->users, $user);
        }
    }

    public function getUsers() {
      return $this->users;
    }

    public function getSpecific() {

    }

}
