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
        $display = '
            <div class="content_mail_display display">
                <span class="content_mail_addressfrom">Envoyé par : <a href="mailto:'.$this->fromaddress.'">'.$this->fromaddress.'</a></span><span class="content_mail_date"> le '.$this->date.'</span><br>
                <span class="content_mail_subject">'.$this->subject.'</span><br>
                <span class="content_mail_body">'.$this->body.'</span>
            </div>
        ';
        return $display;
    }

}