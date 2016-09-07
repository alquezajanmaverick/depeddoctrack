<?php
    include("../../connection/PHPpdo.php");
    $db = new DatabaseConnect();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $x = date_parse($request->datetoSDS);
    $y = date_parse($request->datesubmission);
    $dateSDS = $x['year'].'-'.$x['month'].'-'.$x['day'];
    $datesubmit = $y['year'].'-'.$y['month'].'-'.$y['day'];
    $db->query("CALL updateCongratulatory(?,?,?,?,?,?)");
    $db->bind(1,$dateSDS);
    $db->bind(2,$request->isReleased);
    $db->bind(3,$datesubmit);
    $db->bind(4,$request->itemno);
    $db->bind(5,$request->effectivity);
    $db->bind(6,$request->remarks);
    $db->execute();
