<?php 
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


$db->query("CALL fetchsingleappointee(?)");
$db->bind(1,$request->itemno);
$r = $db->single();

$js = json_encode($r);
echo $js;
