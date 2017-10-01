<?php
session_start();
include_once("../../include/database.php");
$obj = new database();
    $date = date('Y_m_d_h_i_s', time());
    $reload = $_REQUEST['reload'];
    $phoneno = $_REQUEST['phoneno'];
         
    $obj->Save_Sale_History($reload, $phoneno, $date, "PIN");
    $result = array();
    $result['status'] = 1;
    $result['message'] = "";
    echo json_encode($result);
?>
