<?php
include("isvalid.php");
$username=$_SESSION['adminid'];
$pass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$row=$obj->acheck_pass($username,$pass);
if($row)
{
$row=$obj->achange_pss($username,$newpass);
$_SESSION['msg']="Password Updated";
header("location:change.php");
}
else
{
$_SESSION['msg']="Old Password Not Valid";
header("location:change.php");
}
?>