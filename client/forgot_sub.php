<?php
session_start();
include_once("../include/database.php");
$obj= new database();
$email=$_POST['email'];
$row=$obj->forgot_adminpass($email);
if($row)
{
$password=$row['password'];
$to=$email;
	$subject="Password";
	$msg= "Your Password is ".$password;
	$from = "Bullmen<noreply@bullmen.com>";
	$headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .="From:".$from;
	$a=mail($to,$subject,$msg,$headers);
	if($a){
	$_SESSION['msg']="Email Sent";
	header("location:index.php");
	}
}
else
{
$_SESSION['msg']="Email id invalid";
header("location:forgot.php");
}
?>