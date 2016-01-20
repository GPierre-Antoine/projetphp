<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 20/01/16
 * Time: 09:45
 */

class EmailContent {

    private $fromaddress;
    private $subject;
    private $date;
    private $body;

    public function __construct($fromaddress,$subject,$date,$body) {
        $this->fromaddress = $fromaddress;
        $this->subject = $subject;
        $this->date = $date;
        $this->body = $body;
    }

    public function display() {
        echo 'Address : '.$this->fromaddress.' |Subject : '.$this->subject.' |date : '.$this->date.' |body : '.$this->body;
    }

}