<?php
session_start();
include_once("../include/database.php");
$obj= new database();

$symbol = $_REQUEST['symbol'];
$wkn = $_REQUEST['wkn'];
$firma = $_REQUEST['firma'];
$kurs = $_REQUEST['kurs'];
$platz = $_REQUEST['platz'];
$frist = $_REQUEST['frist'];

$_SESSION['symbol'] = $symbol;
$_SESSION['wkn'] = $wkn;
$_SESSION['firma'] = $firma;
$_SESSION['kurs'] = $kurs;
$_SESSION['platz'] = $platz;
$_SESSION['frist'] = $frist;

if( $obj->check_company($symbol, $wkn) ){
    $_SESSION['msg'] = "Same Symbol or WKN address exists";
    header("location:company_manage.php");
}else{
$row = $obj->add_company($symbol, $wkn, $firma, $kurs, $platz, $frist);
if ($row) {
    $_SESSION['msg']="New Company Item Added";
    header("location:company_manage.php");
} else {
    $_SESSION['msg'] = "New Company Reigser Fail";
    header("location:company_manage.php");
}
}
?>