<?php
session_start();
include_once("../../include/database.php");
$obj= new database();
$date = date('Y_m_d_H_i_s', time());
    $sender = $_REQUEST['username'];
    $msg = $_REQUEST['msg'];
    $obj->addMsg_from_agent($sender, $msg, $date);
    echo "success";
?>

