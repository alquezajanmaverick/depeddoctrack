<?php 
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$db->query("CALL deleteappointee(?)");
$db->bind(1,$request->itemno);
$db->execute();
echo $request->itemno;
?>