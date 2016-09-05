<?php
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$x = date_parse($request->dateinformed);
$ddate = $x['year'].'-'.$x['month'].'-'.$x['day'];
$db->query("CALL addappointee(?,?,?,?,?)");
$db->bind(1,$request->itemno);
$db->bind(2,$request->name);
$db->bind(3,$request->position);
$db->bind(4,$ddate);
$db->bind(5,$request->reply);
$db->execute();
?>