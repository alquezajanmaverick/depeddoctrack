<?php
require_once("../../connection/PHPpdo.php");
$db = new DatabaseConnect();
$db->query("CALL `get-asds-process`");
$x = $db->resultset();

$js = json_encode($x);
echo $js;