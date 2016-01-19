<?php
/**
 * Created by Kevin.
 * User: h13002021
 * Date: 21/12/15
 * Time: 22:53
 */

 include_once('ModelPDO.php');

class ConfirmationModel extends ModelPDO {

    public function __construct() {
        parent::__construct();
    }


    public function insert() {

    }

    public function get () {
    }

     public function recup_key_inscription ($key) {
        $sql = 'SELECT * FROM USERS WHERE ENABLE = 0';
         $this->pdo->query($sql);
    }

    public function data_elements($key) {
        $sql='SELECT * FROM USERS WHERE ENABLE = 0';
        $this->pdo->query($sql)->fetch();

    }

    public function validate_inscription($key) {
        $sql = 'UPDATE USERS SET ENABLE = 1 WHERE TOKEN = '. $key;
        $this->pdo->query($sql);
    }




    public function test($key){
        if ($data = $this->data_elements($key))
        {
            echo "<pre>";
            $keybdd = $data['TOKEN'];
            var_dump($keybdd);
            $enable = $data['ENABLE'];
            var_dump($enable);
            echo "</pre>";

        }
        if($enable == 1)
            echo "Votre compte est déjà activé.";
        else
        {
            if($key == $keybdd)
            {
                echo "Votre compte à bien été activé.";
                $this->validate_inscription($key);
            }
            else
                echo "Votre compte ne peut être activé";
        }
    }


    protected function getSpecific(){
    }
}