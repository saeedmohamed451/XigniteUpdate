<?php
session_start();
if($_SESSION['adminid']=="")
{
header("location:index.php");
}
include_once("../include/database.php");
$obj= new database();
?>
