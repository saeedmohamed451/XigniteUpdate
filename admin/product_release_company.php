<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$buyid = $_REQUEST['buyid'];
$obj->product_release_company($buyid);
echo "Released";
  

?>