<?php

function secure_strip($field) {
    return strip_all('[\s\'"]',$field);
}

function POST ($field) {
    return htmlspecialchars($field);
}

function mail_strip($field) {
    $field = strip_all ('/[^\w\-@._+]+/',$field);
    $matches = array();
    $result = preg_match("/^([^+@]+)([^@]+)?(@[^@.]+)(.[\w]+)$/",$field,$matches);

    $return['mail'] = $matches[1] . $matches[3] . $matches [4];
    $return['alias'] = $matches[2];
    return $return;
}

function strip_all($pattern,$field) {
    for ($count = 1;$count !== 0;)
        $result = preg_replace($pattern,'',$field,-1,$count);
    return $result;
}

function hex2rgb($colour) {
    list($r, $g, $b) = sscanf($colour, "#%02x%02x%02x");
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

function blabla ($path)
{
    $task = preg_match("/^\/?([a-zA-Z0-9\-\_]+)\/?(.*)$/", $path, $matches);
    return $matches;

}