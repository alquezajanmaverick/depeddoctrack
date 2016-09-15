<?php 
require_once("../../connection/PHPpdo.php");
if(isset($_POST['itemno'])){
	$x = $_POST['isSDS'];
	if($x == 'true'){$x='YES';}else{$x='NO';}
	$db = new DatabaseConnect();
	$db->query("CALL updateCongratulatory(?,?,?,?,?,?)");
	$db->bind(1,$_POST['datereleased']);
	$db->bind(2,$x);
	$db->bind(3,$_POST['duedate']);
	$db->bind(4,$_POST['itemno']);
	$db->bind(5,$_POST['effectivity']);
	$db->bind(6,$_POST['remarks']);
	if($db->execute()){
		header("Location:congratulatory.php");
	}
}

?>