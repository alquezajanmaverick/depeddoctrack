<?php 
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$db->query("SELECT * from tblpositions WHERE itemno = ? limit 1");
$db->bind(1,$request->item)
$r = $db->single();
$row = $db->rowCount();

$js = json_encode($r);
echo $js;