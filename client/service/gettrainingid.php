<?php

session_start();
include_once("../../include/database.php");
$obj = new database();
$rq = $obj->get_training_data();




$result = array();

$resData = array();

class T1 {
    var $name = "";
}

while ($rs1 = mysql_fetch_assoc($rq)) {
    $d = new T1();
    $d->name = $rs1['training_id'];
    $resData[] = $d;
}
$result['status'] = 1;
$result['result'] = $resData;
echo json_encode($result);
?>

