<?php

function encrypt ($password,$token) {
    echo "<br />encrypt :<pre>";
    var_dump(func_get_args());
    echo "</pre>";
    $result = $password;//hash('sha512',$password);
    return $result.'1';
}