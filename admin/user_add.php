<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$street = $_REQUEST['street'];
$phone = $_REQUEST['phone'];
$balance = $_REQUEST['balance'];
$pass = $_REQUEST['pass'];

$plz = $_REQUEST['plz'];
$ort = $_REQUEST['ort'];
$tel2 = $_REQUEST['tel2'];
$email2 = $_REQUEST['email2'];
$fax = $_REQUEST['fax'];

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['street'] = $street;
$_SESSION['phone'] = $phone;
$_SESSION['balance'] = $balance;
$_SESSION['pass'] = $pass;

$_SESSION['plz'] = $plz;
$_SESSION['ort'] = $ort;
$_SESSION['tel2'] = $tel2;
$_SESSION['email2'] = $email2;
$_SESSION['fax'] = $fax;

if( $obj->check_email($email) ){
    $_SESSION['msg'] = "Same username address exists";
    header("location:user_manage.php");
}else{
$row = $obj->user_register($email, $pass, $name, $balance, $street, $phone, $plz, $ort, $tel2, $email2, $fax);
if ($row) {
    $_SESSION['msg']="New User Added";
    header("location:user_manage.php");
} else {
    $_SESSION['msg'] = "Registeration Fail";
    header("location:user_manage.php");
}
}
?>