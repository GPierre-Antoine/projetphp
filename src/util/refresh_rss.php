<?php
/**
 * Created by PhpStorm.
 * User: h13002021
 * Date: 14/01/16
 * Time: 11:28
 */

$db = new \db\db_handler();
$sql = "SELECT * FROM FLUX";
$stmt = $this->pdo->query($sql);
while ($result = $stmt->fetch())
{
    $newFlux = new Flux($result['ID'],$result['NAME'],$result['URL'],$result['ISFAVORITE']);
    $newFlux->refresh();
}