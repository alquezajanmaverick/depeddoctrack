<?php
require_once('../../../connection/PHPpdo.php');
$db = new DatabaseConnect();
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$xdate = "";
if(($itime = strtotime($request->xdate))!==false)
{
    $xdate = date('y',$itime).'/'.date('m',$itime).'/'.date('d',$itime);
}

$db->query("CALL `set-sds-process`(?,?)");
$db->bind(1,$xdate);
$db->bind(2,$request->itemno);
$db->execute();

?>