<?php
//echo json_encode(array("validation"=>"OK"));
require_once("connection/PHPpdo.php");
$db = new DatabaseConnect();
session_start();
if(isset($_POST['username']))
{
    
    $db->query("SELECT * from tblusers WHERE UserName = ? AND Password = ? limit 1");
    $db->bind(1,$_POST['username']);
    $db->bind(2,$_POST['password']);
    $s = $db->single();
    $rc = $db->rowCount();
    if($rc > 0)
    {
        echo "OK";
        $_SESSION['user']=$s['Privilege'];
        
    }
}