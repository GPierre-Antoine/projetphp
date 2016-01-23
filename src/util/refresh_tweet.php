<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 23/01/16
 * Time: 21:34
 */

include_once('db_wrap.php');

include ("/home/aaron-aaron/www/src/class/Twitter.php");

$bd = new \db\db_handler();
$bd->init();

$sql = "DELETE FROM TWEET";
$bd->query($sql);

$sql = "SELECT * FROM TWITTER";
$stmt = $bd->query($sql);
while ($result = $stmt->fetch())
{
    $newFlux = new Twitter($result['ID'],$result['NAME']);
    $newFlux->refresh();
}

$bd->close();