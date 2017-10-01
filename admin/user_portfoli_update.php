<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$symbol = $_REQUEST['symbol'];
$name = $_REQUEST['name'];
//$changes = $_REQUEST['changes'];
$changes = "";
$dates = $_REQUEST['dates'];
$price = $_REQUEST['price'];
$quantity = $_REQUEST['quantity'];
$productid = $_REQUEST['productid'];
$user_id = $_SESSION['user_id'];
$date=date_create($dates);
$dates = date_format($date,"Y-m-d H:i:s");
     $row = $obj->product_update($productid, $symbol, $name, $changes, $dates, $price, $quantity);
        if( $row ){
            $_SESSION['msg']="Updated Success";
            header("location:user_portfoli.php?user_id=$user_id");
        }else{
            $_SESSION['msg'] = "Update Error";
            header("location:user_portfoli.php?user_id=$user_id");
        }
    

?>