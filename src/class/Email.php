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

    public function __construct($id,$address,$pass,$server,$port) {
        $this->id = $id;
        $this->address = $address;
        $this->pass = $pass;
        $this->server = $server;
        $this->port = $port;

        $this->mails = array();
        $this->pdo = new \db\db_handler();
    }

    public function connect() {
        $this->conn = imap_open('{'.$this->server.':'.$this->port.'}', $this->$address, $this->pass) or die(imap_last_error());
    }

    public function read() {
        $this->$nb_msg = imap_num_msg($this->conn);

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
            $body = imap_body($this->conn, $this->nb_msg);

            //save to MySQL
            $query = "INSERT INTO EMAIL_INFORMATION (IDMAIL,FROMADDRESS,SUBJECT,DATE,BODY) VALUES (".$this->id.",\"".$fromaddress."\", \"".$subject."\",\"".$date."\",\"".$body."\")";
            $this->pdo->query($query);

            //save to array
            $newMail = new EmailContent($fromaddress,$subject,$date,$body);
            array_push($this->mails,$newMail);

            //delete email
            imap_delete($this->conn, 1);
            imap_expunge($this->conn);
        }
    }

    public function getMails() {
        return $this->mails;
    }

}