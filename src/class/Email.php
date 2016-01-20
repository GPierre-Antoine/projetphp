<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 20/01/16
 * Time: 09:25
 */

include_once('EmailContent.php');

class Email {

    private $id;
    private $address;
    private $pass;
    private $server;
    private $port;

    private $conn;
    private $nb_msg;

    private $mails;
    private $pdo;

    public function __construct($id,$address,$pass) {
        $this->id = $id;
        $this->address = $address;
        $this->pass = $pass;

        $this->mails = array();
        $this->pdo = new \db\db_handler();
    }

    public function setServer($server,$port) {
        $this->server = $server;
        $this->port = $port;
    }

    public function refresh() {
        $this->connect();
        $this->read();
    }

    private function connect() {
        $this->conn = imap_open('{'.$this->server.':'.$this->port.'/imap/ssl}', $this->address, $this->pass) or die(imap_last_error());
    }

    private function read() {
        $this->nb_msg = imap_num_msg($this->conn);

        if($this->nb_msg > 0) {
            //get from, date and subject
            $header = imap_headerinfo($this->conn, 1);
            $from = $header->from;
            $fromaddress = "";
            foreach($from as $id=>$object) {
                $fromaddress = $object->mailbox . "@" . $object->host;
            }
            $subject = $header->subject;
            $date = $header->date;

            //read the body
            $body = imap_fetchbody($this->conn, $this->nb_msg, 1);

            //make check
            $key = md5($fromaddress.$subject.$date.$body);

            //save to MySQL
            $sql = "SELECT count(*) FROM EMAIL_INFORMATION WHERE IDMAIL = ".$this->id." AND CHECKVERS = \"".$key."\"";
            $resul = $this->pdo->query($sql)->fetch();
            if ($resul[0] == 0) {
                $query = "INSERT INTO EMAIL_INFORMATION (IDMAIL,FROMADDRESS,SUBJECT,DATE,BODY,CHECKVERS) VALUES (".$this->id.",\"".$fromaddress."\", \"".$subject."\",\"".$date."\",\"".$body."\",\"".$key."\")";
                $this->pdo->query($query);

                //save to array
                $newMail = new EmailContent($fromaddress,$subject,$date,$body);
                array_push($this->mails,$newMail);
            }
        }
    }

    public function getMails() {
        return $this->mails;
    }

    public function getAddress() {
        return $this->address;
    }

    public function initializeMailsInside() {
        $sql = "SELECT * FROM EMAIL_INFORMATION WHERE IDMAIL = ".$this->id;
        $stmt = $this->pdo->query($sql);
        while($result = $stmt->fetch())
        {
            $mail = new EmailContent($result['FROMADDRESS'],$result['SUBJECT'],$result['DATE'],$result['BODY']);
            array_push($this->mails,$mail);
        }
    }

}