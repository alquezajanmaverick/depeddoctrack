<?php include('begin.php'); ?>
<?php
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db = new DatabaseConnect();

$db->query();
$db->bind(1,$request->item);
$x = $db->single();

$js = json_encode($x);
echo $js;