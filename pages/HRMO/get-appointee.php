<?php 
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db->query("CALL fetchappointee");
$x = $db->resultset();
$js = json_encode(array_values($x));
echo $js;
?>