<?php 
require_once("../../connection/PHPpdo.php");
if(isset($_POST['itemno'])){
	$x = $_POST['isSDS'];
	$y = $_POST['datereleased'];
	if($y==''){$y=null;}
	if($x == 'true'){$x='YES';}else{$x='NO';}
	$db = new DatabaseConnect();
	$db->query("CALL updateCongratulatory(?,?,?)");
	$db->bind(1,$y);
	$db->bind(2,$x);
	$db->bind(3,$_POST['itemno']);
	if($db->execute()){
		header("Location:congratulatory.php");
	}
}

?>