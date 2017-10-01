<?php

session_start();
include_once("../include/database.php");
$obj = new database();
$name = $_POST['name'];
$phone = $_POST['phone'];
$street = $_POST['street'];
$userid = $_SESSION['userid'];
$pass = $_POST['password'];
$plz = $_REQUEST['plz'];
$ort = $_REQUEST['ort'];
$tel2 = $_REQUEST['tel2'];
$email2 = $_REQUEST['email2'];
$fax = $_REQUEST['fax'];


$row = $obj->user_update($userid, $name, $street, $phone, $pass, $plz, $ort, $tel2, $email2, $fax);
if ($row) {
    header("location:admin_home.php");
} else {
    header("location:admin_home.php");
}
?>