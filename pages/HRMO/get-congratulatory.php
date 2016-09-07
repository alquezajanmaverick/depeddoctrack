<?php
    include("../../connection/PHPpdo.php");
    $db = new DatabaseConnect();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $db->query("CALL fetchcongratulatory(?)");
    $db->bind(1,$request->itemno);
    $x = $db->single();

    $js = json_encode($x);
    echo $js;
?>