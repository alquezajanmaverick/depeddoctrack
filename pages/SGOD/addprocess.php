<?php
include("../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db->query("INSERT INTO `tblpositions`(`itemno`, `position`, `positioncategory`, `schoollevel`, `district`, `schoolid`, `schoolname`) VALUES (?,?,?,?,?,?,?)");
$db->bind(1,$request->itemno);
$db->bind(2,$request->position);
$db->bind(3,$request->category);
$db->bind(4,$request->level);
$db->bind(5,$request->district);
$db->bind(6,$request->schoolID);
$db->bind(7,$request->school);
$db->execute();
$db->close();