<?php
session_start();
include_once("../../include/database.php");
$obj= new database();
$date = date('Y_m_d_h_i_s', time());


	$username = $_REQUEST['username'];
        $time = $_REQUEST['time'];
        
$rs = $obj->agent_data_id($username);
echo $obj->getMsg_from_agent($username, $time, $rs);
?>