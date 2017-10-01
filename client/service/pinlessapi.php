<?php
session_start();
include_once("../../include/database.php");
$obj = new database();
    $date = date('Y_m_d_h_i_s', time());
    $reload = $_REQUEST['reload'];
    $phoneno = $_REQUEST['phoneno'];
    $balance =$_REQUEST['balance'];
    $agentid = $_REQUEST['userid'];
   // if(intval($balance) > intval($reload) ){
     //   $balance = intval($balance) - intval($reload);
      //  UpdateBalance($loginid, $balance);
        $obj->Save_Sale_History($reload, $phoneno, $date, "PINLESS");
        $result = array();
        $result['status'] = 1;
        $result['message'] = "";
        echo json_encode($result);
    /*}else{
        $result = array();
        $result['status'] = 0;
        $result['message'] = "Balance is smaller than amount.";
        echo json_encode($result);
    }*/
    
?>
