<?php 
include("../../connection/db.inc.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


$db->query("CALL fetchpositions");
$r = $db->resultset();
$row = $db->rowCount();

if($row >0)
{
    $js = json_encode($r);
    echo $js;
}
