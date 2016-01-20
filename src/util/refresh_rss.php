<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 14/01/16
 * Time: 11:28
 */

include_once('db_wrap.php');

include ("/home/aaron-aaron/www/src/class/Flux.php");
include ("/home/aaron-aaron/www/src/class/FluxArticle.php");
include ("/home/aaron-aaron/www/src/class/FluxUser.php");

$bd = new \db\db_handler();
$bd->init();

$sql = "SELECT * FROM FLUX";
$stmt = $bd->query($sql);
while ($result = $stmt->fetch())
{
    $newFlux = new Flux($result['ID'],$result['URL']);
    $newFlux->refresh();
}

$bd->close();