<?php

function encrypt ($password,$token) {
    echo "<pre>";
    var_dump(func_get_args());
    echo "</pre>";
    $result = $password . $token;
    $result = hash('sha512',$result);
    return $result;
}