<?php
include("isvalid.php");
$center=$_POST['center'];
$id=$_POST['id'];
$tit=$_POST['tit'];
$url=$_POST['url'];
$txt_size=$_POST['txt_size'];
$btn_color=$_POST['btn_color'];
$txt_color=$_POST['txt_color'];
$img=date('his').basename($_FILES['file']['name']);
$path="gallery//$img";
$type=$_FILES['file']['type'];
if($img){
if($type=="image/jpeg" || $type=="image/png" || $type=="image/jpg" || $type=="image/gif" || $type=="image/bmp")
{
move_uploaded_file($_FILES['file']['tmp_name'],$path);
}
else
{
$_SESSION['msg']="Upload Only in Image formats";
header("location:flash.php");	
}}

else{
$img=$_POST['nimg'];
}

$rs=$obj->update_photo($id,$center,$tit,$img,$url,$txt_size,$txt_color,$btn_color);
if($rs)
{
$_SESSION['msg']="Update Succsessfully";
header("location:flash.php");
}
else
{
$_SESSION['msg']="Not Update Succsessfully";
header("location:flash.php");
}


?>