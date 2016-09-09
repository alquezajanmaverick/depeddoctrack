<?php
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$db->query("SELECT itemno from tblpositions WHERE position = ?");
$db->bind(1,$request->item);
$x = $db->single();

$js = json_encode($x);
echo $js;
