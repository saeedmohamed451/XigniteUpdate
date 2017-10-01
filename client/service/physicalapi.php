<?php
session_start();
include_once("../../include/database.php");
$obj = new database();
    $date = date('Y_m_d_h_i_s_a', time());
    $loginid = $_SESSION['userid'];
    $reload = $_REQUEST['reload'];
    $phoneno = $_REQUEST['phoneno'];
    $balance =$_REQUEST['balance'];
    $voucher =$_REQUEST['voucher'];
    
    if( $obj->getVoucher($voucher) == true){
        $obj->SaveVoucherHistory($reload, $phoneno, $voucher, $date);
        $result['status'] = 1;
        $result['message'] = "";
        echo json_encode($result); 
    }else{
        $result['status'] = 0;
        $result['message'] = "There is no same voucher number on DB.";
        echo json_encode($result); 
    }
               
?>

