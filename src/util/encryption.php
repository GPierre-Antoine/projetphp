<?php

function encrypt ($password,$token) {
    $result = $password . $token;
    $result = hash('sha512',$result,true);
    return $result;
}