<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$desc1 = $_REQUEST['desc1'];
$desc2 = $_REQUEST['desc2'];
$desc3 = $_REQUEST['desc3'];
$desc4 = $_REQUEST['desc4'];

$row = $obj->update_desc($desc1, $desc2, $desc3, $desc4);
header("location:admin_home_desc.php");
    

?>