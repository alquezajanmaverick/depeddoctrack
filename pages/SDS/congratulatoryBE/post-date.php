<?php 
	require_once("../../../connection/PHPpdo.php");
	$db = new DatabaseConnect();

	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$xdate = "";
	if(($itime = strtotime($request->SDSreleaseddate))!==false)
	{
		$xdate = date('y',$itime).'/'.date('m',$itime).'/'.date('d',$itime);
	}
	$db->query("CALL marksds(?,?)");
	$db->bind(1,$xdate);
	$db->bind(2,$request->itemno);
	if($db->execute()){
		$db->query("CALL fetchCongSDS");
		$x = $db->resultset();
		
		$js = json_encode($x);
		echo $js;		
	}

	
?>