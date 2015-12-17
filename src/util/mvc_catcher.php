<?php


function arrange_dir (&$array,$base) {
    foreach ($array as $line) {
        $newarray[substr($line,0,-4)] = $base.$line;
    }
    $array =  $newarray;
}

//models
$base="/home/aaron-aaron/www/";
$src = "src/";
$dir = "model/";
$fd = opendir($base.$src.$dir);

while (false !== ($filename = readdir($fd))) {
    if (substr($filename, 0, 1) !== '.')
        $models[] = $filename;
}
arrange_dir($models,$src.$dir);
//controllers
$dir = "controller/";
$fd = opendir($base.$src.$dir);

while (false !== ($filename = readdir($fd))) {
    if (substr($filename, 0, 1) !== '.') {
        $controllers[] = $filename;
    }
}
arrange_dir($controllers,$src.$dir);
//views

$dir = "view/";
$fd = opendir($base.$src.$dir);

while (false !== ($filename = readdir($fd))) {
    if (substr($filename, 0, 1) !== '.')
        $views[] = $filename;
}
arrange_dir($views,$src.$dir);

