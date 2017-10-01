<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$pass = $_REQUEST['pass'];
$userid = $_REQUEST['userid'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$street = $_REQUEST['street'];
$phone = $_REQUEST['phone'];
$balance = $_REQUEST['balance'];
$plz = $_REQUEST['plz'];
$ort = $_REQUEST['ort'];
$tel2 = $_REQUEST['tel2'];
$email2 = $_REQUEST['email2'];
$fax = $_REQUEST['fax'];


if( $obj->check_email_update($userid, $email) ){
    $_SESSION['msg'] = "Same Username address exists";
    header("location:user_list.php");
}else{
        
        $row = $obj->user_updatefull($userid, $email, $pass, $name, $street, $phone, $balance, $plz, $ort, $tel2, $email2, $fax);
        if( $row ){
            $_SESSION['msg']="$userid user Updated";
            header("location:user_list.php");
        }else{
            $_SESSION['msg'] = "$userid user Update Error";
            header("location:user_list.php");
        }
}
    

?>