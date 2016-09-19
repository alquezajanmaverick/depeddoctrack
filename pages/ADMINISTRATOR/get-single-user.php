<?php
require_once("../../connection/PHPpdo.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db = new DatabaseConnect();
$db->query("CALL `get-single-user`(?)");
$db->bind(1,$request->userID);
$x = $db->resultset();

$js = json_encode($x);
echo $js;