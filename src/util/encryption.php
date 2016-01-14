<?php

function encrypt ($password,$token) {
    $result = $password . bin2hex($token);
    $result = hash('sha512',$result,true);
    return $result;
}