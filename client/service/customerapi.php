<?php
session_start();
include_once("../../include/database.php");
$obj = new database();

    $date = date('Y_m_d_h_i_s', time());
    $msisdn = $_REQUEST['msisdn'];
    $simsn = $_REQUEST['simsn'];
    $name = $_REQUEST['name'];
    $nric = $_REQUEST['nric'];
    $dob = $_REQUEST['dob'];
    $sex = $_REQUEST['sex'];
    $address = $_REQUEST['address'];
    $passport = $_REQUEST['passport'];
    $signature = $_REQUEST['signature'];
    
    if( $obj->isExistCustomer($msisdn) == false ){
        $obj->AddCustomer($name,$msisdn,$simsn,$nric,$dob,$sex,$address,$signature,$passport);
        $result = array();
        $result['status'] = 1;
        $result['message'] = "Customer Information is Saved.";
        echo json_encode($result);
    }else{
        $result = array();
        $result['status'] = 0;
        $result['message'] = "There is same MSISDN.";
        echo json_encode($result);
    }
    
    
?>
