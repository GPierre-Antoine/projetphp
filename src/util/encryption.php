<?php

function encrypt ($password,$token) {
    $result = hash('sha512',$password.$token);
    return $result;
}

function random_string_token ($length,&$crypto_strong = true) {
    return bin2hex(openssl_random_pseudo_bytes($length,$crypto_strong));
}