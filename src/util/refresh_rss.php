<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 14/01/16
 * Time: 11:28
 */


$db = new PDO('mysql:host=mysql-aaron-aaron.alwaysdata.net;dbname=aaron-aaron_iut','116440_naga','rpekgggh');
$sql = "SELECT * FROM FLUX";
$stmt = $db->query($sql);
while ($result = $stmt->fetch())
{
    $newFlux = new Flux($result['ID'],$result['URL']);
    $newFlux->refresh();
}