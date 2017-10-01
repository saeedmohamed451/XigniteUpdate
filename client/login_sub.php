<?php

session_start();
include_once("../include/database.php");
$obj = new database();
$username = $_POST['username'];
$pass = $_POST['password'];
$row = $obj->agent_login($username, $pass);
if ($row) {
    $_SESSION['agentid'] = $row['agent_id'];
    header("location:admin_home.php");
} else {
    $_SESSION['msg'] = "Invalid username and password";
    header("location:index.php");
}
?>