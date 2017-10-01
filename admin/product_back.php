<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$buyid = $_REQUEST['buyid'];
$back_money = $_REQUEST['back_money'];
$user_id = $_REQUEST['user_id'];
$obj->product_back_money($user_id, $buyid, $back_money);
echo "Back Money";
  

?>