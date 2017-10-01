<?php
session_start();
include_once("../../include/database.php");
$obj = new database();
$res = $obj->getAllOperator();
	$result = array();
	$result['status'] = 0;
	$resData = array();
	class T1{
		var $name = "";
	}
	while( $row = mysql_fetch_object($res) ){
		$d = new T1();
		$d->name = $row->name;
		$resData[] = $d;
	}
	$result['result'] = $resData;
	echo json_encode($result);
?>

