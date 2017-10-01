<?php
include("isvalid.php");
$userid = $_REQUEST['user_id'];
$row=$obj->del_user($userid);
if($row) 
{
    $_SESSION['msg']="$userid User Deleted";	
    header("location:user_list.php");
}
else
{
    $_SESSION['msg']="$userid Not Deleted";	
    header("location:user_list.php");
}
?>