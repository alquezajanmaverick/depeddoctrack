<?php
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$db->query("DELETE FROM `tblpositions` WHERE `itemno` = ?");
$db->bind(1,$request->item);
$db->execute();


$db->query("SELECT * from tblpositions");
$r = $db->resultset();
$row = $db->rowCount();

if($row > 0)
{
    $js = json_encode($r);
    echo $js;
}
