<?php

function encrypt ($password,$token) {
    $result = hash('sha512',$password);
    return $result;
}

function random_string_token ($length,&$crypto_strong) {
    return bin2hex(openssl_random_pseudo_bytes($length,$crypto_strong));
}