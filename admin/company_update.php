<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$companyid = $_REQUEST['companyid'];
$symbol = $_REQUEST['symbol'];
$wkn = $_REQUEST['wkn'];
$firma = $_REQUEST['firma'];
$kurs = $_REQUEST['kurs'];
$platz = $_REQUEST['platz'];
$frist = $_REQUEST['frist'];

if( $obj->check_company_update($companyid, $symbol, $wkn) ){
    $_SESSION['msg'] = "Same Symbol or WKN address exists";
    header("location:company_list.php");
}else{
$row = $obj->company_update($companyid, $symbol, $wkn, $firma, $kurs, $platz, $frist);
if ($row) {
    $_SESSION['msg']="Company Item Updated";
    header("location:company_list.php");
} else {
    $_SESSION['msg'] = "Company Update Fail";
    header("location:company_list.php");
}
}
?>