<?php 
require_once("../../connection/PHPpdo.php");
if(isset($_POST['itemno'])){
	$db = new DatabaseConnect();
	$db->query("CALL editappointee(?,?,?,?,?,?,?)");
	$db->bind(1,$_POST['itemno']);
	$db->bind(2,$_POST['name']);
	$db->bind(3,$_POST['dateinformed']);
	$db->bind(4,$_POST['reply']);
	$db->bind(5,$_POST['effectivity']);
	$db->bind(6,$_POST['remarks']);
	$db->bind(7,$_POST['duedate']);
	if($db->execute()){
		header("Location:assignment.php");
	}
	
}
?>