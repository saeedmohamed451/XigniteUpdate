<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$sname=ucfirst($_POST['sname']);
$stitle=ucfirst($_POST['stitle']);
$semail=$_POST['semail'];
$sphone=$_POST['sphone'];
$aemail=$_POST['aemail'];
$sfax=$_POST['sfax'];
$address=$_POST['address'];


$img=$_FILES['img']['name'];


if($img){

$file1=basename($_FILES['img']['name']);
$type= $_FILES['img']['type'];
$img1=date("Ymdhis")."1".$file1;
$path="../img/$img1";

if($type=="image/jpeg" || $type=="image/png" || $type=="image/jpg" || $type=="image/gif" || $type=="image/bmp")
{
move_uploaded_file($_FILES['img']['tmp_name'],$path);
$logo=$img1;
}
else{

 $_SESSION['msg']="Image Format not valid!";
header("location:setting.php");
}
}
else
{
$rs123=$obj->fetch_site_detail(1); 
$logo=$rs123['logo'];
}


$row=$obj->update_detail($sname,$stitle,$semail,$sphone,$aemail,$logo,$sfax,$address);
if($row)
{
$_SESSION['msg']="Updated";
header("location:setting.php");
}
else
{
$_SESSION['msg']="Error";
header("location:setting.php");
}
?>