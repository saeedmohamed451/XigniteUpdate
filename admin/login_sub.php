

<?php

session_start();
include_once("../include/database.php");
$obj = new database();
$username = $_POST['username'];
$pass = $_POST['password'];
$row = $obj->admin_login($username, $pass);
if ($row) {
    $_SESSION['adminid'] = $row['id'];
    $_SESSION['admin_email'] = $row['email'];
    header("location:admin_home.php");
} else {
    $_SESSION['msg'] = "Invalid username and password";
    header("location:index.php");
}
?>