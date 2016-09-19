<?php
require_once("../../connection/PHPpdo.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db = new DatabaseConnect();
$db->query("CALL `set-user`(?,?,?)");
$db->bind(1,$request->username);
$db->bind(2,$request->password);
$db->bind(3,$request->userID);
$db->execute();
