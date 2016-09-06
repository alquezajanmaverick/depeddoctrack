<?php
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$x = date_parse($request->dateinformed);
$ddate = $x['year'].'-'.$x['month'].'-'.$x['day'];
$db->query("CALL editappointee(?,?,?,?,?,?)");
$db->bind(1,$request->itemno);
$db->bind(2,$request->olditemno);
$db->bind(3,$request->name);
$db->bind(4,$request->position);
$db->bind(5,$ddate);
$db->bind(6,$request->reply);

$db->execute();