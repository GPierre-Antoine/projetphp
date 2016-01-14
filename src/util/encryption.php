<?php

function encrypt ($password,$token) {
    echo "<br />encrypt :<pre>";
    var_dump(func_get_args());
    echo "</pre>";
    $result = hash('sha512',$password.$token);
    return $result;
}