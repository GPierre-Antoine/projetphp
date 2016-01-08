<?php

include_once("db_wrap.php");

function error_handler ($errno, $errstr, $errfile, $errline, $context = null) {

    if (!(error_reporting() & $errno))
    {
        //unreported error;
        return;
    }

    $db = new \db\db_handler();

    $continue = true;


    switch ($errno)
    {
        case E_ERROR:
            $continue = false;
            break;
        case E_WARNING:
            break;
        case E_PARSE:
            break;
        case E_NOTICE:
            break;
        case E_CORE_ERROR:
            $continue = false;
            break;
        case E_CORE_WARNING:
            $continue = false;
            break;
        case E_COMPILE_ERROR:
            $continue = false;
            break;
        case E_COMPILE_WARNING:
            $continue = false;
            break;
        case E_USER_ERROR:
            $continue = false;
            break;
        case E_USER_WARNING:
            break;
        case E_USER_NOTICE:
            break;
        case E_STRICT:
            break;
        case E_RECOVERABLE_ERROR:
            break;
        case E_DEPRECATED:
            break;
        case E_USER_DEPRECATED:
            break;
        default:
            $continue = false;
            break;
    }

    $sentence = "INSERT INTO `ERRORS` (`ERRNO`,`WHAT`,`FILE`,`LINE`) VALUES (?,?,?,?)";

    $db->prepare($sentence);
    $db->execute($errno,$errstr,$errfile,$errline);



}


function fatal_error_handler () {
    $last_error = error_get_last();
    error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
}


set_error_handler("error_handler");
register_shutdown_function('fatal_error_handler');