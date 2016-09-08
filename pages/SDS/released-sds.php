<?php 
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

    $x = date_parse($request->xdate);
    $dateSDS = $x['year'].'-'.$x['month'].'-'.$x['day'];

$db->query("CALL marksds(?,?)");
$db->bind(1,$dateSDS);
$db->bind(2,$request->itemno);
$db->execute();