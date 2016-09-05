<?php include('begin.php'); ?>
<?php
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db = new DatabaseConnect();
$db->query("UPDATE `tblpositions` SET `itemno`=?,`position`=?,`positioncategory`=?,`schoollevel`=?,`district`=?,`schoolid`=?,`schoolname`=? WHERE `itemno` = ? limit 1");
$db->bind(1,$request->itemno);
$db->bind(2,$request->position);
$db->bind(3,$request->positioncategory);
$db->bind(4,$request->level);
$db->bind(5,$request->district);
$db->bind(6,$request->schoolID);
$db->bind(7,$request->school);
$db->bind(8,$request->key);
if($db->execute()){
    echo "[{data:'OK'}]";
}
