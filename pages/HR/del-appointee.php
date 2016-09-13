<?php 
require_once("../../connection/PHPpdo.php");
if(isset($_GET['itemno'])){
	$db = new DatabaseConnect();
	$db->query("CALL `deleteappointee`(?)");	
	$db->bind(1,$_GET['itemno']);
	if($db->execute()){
		header("Location:assignment.php");	
	}
	else
	{
		echo "<script>alert('Something happened!The transaction did not completed successfully')</script>";
	}
}


?>