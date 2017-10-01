<?php
include("isvalid.php");
$username=$_SESSION['adminid'];
$email=$_POST['email'];

$row=$obj->email_change($username,$email);
if($row)
{
$_SESSION['admin_email']=$email;
$_SESSION['msg']="Email Updated";
header("location:change.php");
}
else
{
$_SESSION['msg']="Error";
header("location:change.php");
}
?>