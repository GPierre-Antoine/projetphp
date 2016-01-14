<?php

function encrypt ($password,$token) {
    $result = hash('sha512',$password);
    return $result;
}