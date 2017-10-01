<?php
session_start();
include_once("../../include/database.php");
$obj = new database();
    $loginid = $_REQUEST['userid'];

    $date = date('Y_m_d_h_i_s_a', time());
    $balance =$_REQUEST['balance'];
    $amount = $_REQUEST['amount'];
    $account = $_REQUEST['account'];
    $operator = $_REQUEST['phone'];
    
   // if( isOperator($operator) ){
       // if( intval($balance) > intval($amount) ){
         //   $balance = intval($balance) - intval($amount);
         //   UpdateBalance($loginid, $balance);
            $result = array();
            $result['status'] = 1;
            $result['message'] = "";
            echo json_encode($result); 
       // }else{
       //     $result = array();
      //      $result['status'] = 0;
       //     $result['message'] = "Balance is smaller than amount.";
      //      echo json_encode($result);
       // }
    /*}else{
        $result = array();
        $result['status'] = 0;
        $result['message'] = "There is no bill account No on server.";
        echo json_encode($result);
    }*/
               
?>

