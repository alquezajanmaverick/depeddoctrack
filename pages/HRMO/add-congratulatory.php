<?php
    include("../../connection/PHPpdo.php");
    $db = new DatabaseConnect();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $db->query("");
    $db->bind(1);
    $db->bind(1);
    $db->bind(1);
    $db->bind(1);
    $db->bind(1);
    $db->execute();
