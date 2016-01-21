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
        $this->close();
    }

    private function connect() {
        $this->conn = imap_open("{".$this->server.":".$this->port."/imap/ssl}", $this->address, $this->pass) or die(imap_last_error());
    }

    private function read() {
        $allMails = imap_search($this->conn,'ALL');

        if($allMails) {
            rsort($allMails);

            foreach($allMails as $email_number) {
                $overview = imap_fetch_overview($this->conn,$email_number,0);
                $structure = imap_fetchstructure($this->conn, $email_number);

                $body = '';
                if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
                    $part = $structure->parts[1];
                    $body = imap_fetchbody($this->conn,$email_number,2);

                    if($part->encoding == 3) {
                        $body = imap_base64($body);
                    } else if($part->encoding == 1) {
                        $body = imap_8bit($body);
                    } else {
                        $body = imap_qprint($body);
                    }
                }
                $body = utf8_decode($body);
                $fromaddress = utf8_decode(imap_utf7_encode($overview[0]->from));
                $subject = mb_decode_mimeheader($overview[0]->subject);
                $date = utf8_decode(imap_utf8($overview[0]->date));
                //$date = date('Y-m-d H:i:s',$date);
                $key = md5($fromaddress.$subject.$body);

                //save to MySQL
                $sql = "SELECT count(*) FROM EMAIL_INFORMATION WHERE IDMAIL = ".$this->id." AND CHECKVERS = \"".$key."\"";
                $resul = $this->pdo->query($sql)->fetch();
                if ($resul[0] == 0) {
                    $this->pdo->prepare("INSERT INTO EMAIL_INFORMATION (IDMAIL,FROMADDRESS,SUBJECT,DATE,BODY,CHECKVERS) VALUES (?,?,?,?,?,?)");
                    $this->pdo->execute(array($this->id,$fromaddress,$subject,$date,$body,$key));
                }

            }
        }
    }

    private function close() {
        imap_close($this->conn);
    }

    public function initializeMails() {
        $sql = "SELECT * FROM EMAIL_INFORMATION WHERE IDMAIL = ".$this->id;
        $stmt = $this->pdo->query($sql);
        while($result = $stmt->fetch())
        {
            $mail = new EmailContent($result['FROMADDRESS'],$result['SUBJECT'],$result['DATE'],$result['BODY']);
            array_push($this->mails,$mail);
        }
    }

    public function getMails() {
        return $this->mails;
    }

    public function getAddress() {
        return $this->address;
    }

}