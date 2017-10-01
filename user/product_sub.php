<?php
include("isvalid.php");
$name=str_replace("'", "\'",ucfirst($_POST['name']));
$code=$_POST['code'];
$desc=str_replace("'", "\'",$_POST['desc']);
$subdesc=str_replace("'", "\'",$_POST['subdesc']);
$seotit=str_replace("'", "\'",$_POST['seotit']);
$seodesc=str_replace("'", "\'",$_POST['seodesc']);
$seokey=str_replace("'", "\'",$_POST['seokey']);
$price=$_POST['price'];
$dprice=$_POST['dprice'];
$wprice=$_POST['wprice'];
$scharge=$_POST['scharge'];
$discount=$_POST['discount'];
$brand=$_POST['brand'];
$category=$_POST['category'];
$subcategory=$_POST['subcategory'];
$subtopic=$_POST['subtopic'];
$stockstatus=$_POST['stockstatus'];

$img=$_FILES['img']['name'];
$file1=basename($_FILES['img']['name']);
$type= $_FILES['img']['type'];
$img1=date("Ymdhis")."1".$file1;
$path1="../product/$img1";

$img="product/$img1";



if($type=="image/jpeg" || $type=="image/png" || $type=="image/jpg" || $type=="image/gif" || $type=="image/bmp")
{
move_uploaded_file($_FILES['img']['tmp_name'],$path1);
$row=$obj->add_product($name,$code,$desc,$seotit,$seodesc,$seokey,$price,$dprice,$wprice,$scharge,$category,$subcategory,$subtopic,$img1,$brand,$subdesc,1,$discount,$stockstatus);
if($row)
{
$pid=$row;

$_SESSION['msg']="add";
header("location:addproduct.php");
}
else
{
$_SESSION['msg']="Error";
header("location:addproduct.php");
}
}
else
{

 $_SESSION['msg']="Image Format not valid!";
header("location:addproduct.php");
}
?>