<?php
require_once("../../../connection/PHPpdo.php");
$db = new DatabaseConnect();

$db->query("CALL `track-warning`");
$x = $db->resultset();
$r = $db->rowCount();

if($r>0){
    $js = json_encode($x);
    echo $js;
}else{
    $js = "[{row:".$r."}]";
    echo $js;
}
?>