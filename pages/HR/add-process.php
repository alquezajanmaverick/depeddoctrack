<?php
require_once("../../connection/PHPpdo.php");
	
	if(isset($_POST['schoolname'])){
		$db = new DatabaseConnect();
		$db->query("CALL addappointee(?,?,?,?,?,?,?,?,?,?,?)");
		$db->bind(1,$_POST['itemno']);
		$db->bind(2,$_POST['name']);
		$db->bind(3,$_POST['pos']);
		$db->bind(4,$_POST['category']);
		$db->bind(5,$_POST['dateinformed']);
		$db->bind(6,$_POST['reply']);
		$db->bind(7,$_POST['schoolID']);
		$db->bind(8,$_POST['schoolname']);
		$db->bind(9,$_POST['effectivity']);
		$db->bind(10,$_POST['remarks']);
		$db->bind(11,$_POST['duedate']);
		if($db->execute())
		{
			header("Location:assignment.php")	;
		}
	}