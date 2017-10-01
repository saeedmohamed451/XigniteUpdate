<?php

session_start();
include_once("../include/database.php");
$obj = new database();
$name = $_POST['username'];
$pass = $_POST['password'];
$email = $_POST['email'];
$street = $_POST['street'];
$phone = $_POST['phone'];
$balance = $_POST['balance'];
if( $obj->check_email($email) ){
    $_SESSION['msg'] = "Same Email address exists";
    header("location:register.php");
}else{
$row = $obj->user_register($email, $pass, $name, $balance, $street, $phone);
if ($row) {
    $_SESSION['userid'] = $row;
    header("location:admin_home.php");
} else {
    $_SESSION['msg'] = "Registeration Fail";
    header("location:register.php");
}
}
?>