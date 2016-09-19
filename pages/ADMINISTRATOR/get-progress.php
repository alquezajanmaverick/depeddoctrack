<?php
require_once("../../connection/PHPpdo.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db = new DatabaseConnect();
$db->query("CALL `get-progress`(?)");
$db->bind(1,$request->itemno);
$x = $db->resultset();

$js = json_encode($x);
echo $js;