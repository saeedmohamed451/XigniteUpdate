<?php

session_start();
include_once("../include/database.php");

$obj = new database();
$name = $_REQUEST['name'];
$symbol = $_REQUEST['symbol'];
$change = $_REQUEST['change'];



$datetime = date('Y-m-d H:i:s');//$_REQUEST['datetime'];
$quantity = $_REQUEST['quantity'];
$price = $_REQUEST['price'];
$userid = $_SESSION['userid'];

$limit = $_REQUEST['limit'];
$place = $_REQUEST['place'];

$date = new DateTime($datetime);
$datetime = $date->format('Y-m-d H:i:s');

$rw = $obj->get_user_info($userid);
$balance = $rw['balance'];

if( $balance >= $price * $quantity) {
    if( $obj->buy_product($userid, $symbol, $name, $change, $datetime, $price, $quantity, $balance, $limit, $place) )
    {
        echo "Kaufbetrag wurde erfolgreich abgebucht";
        $user_name = $rw['name'];
        $user_email = $rw['email'];
        $sub = "$user_name($user_email) kaufen";
        $content = "Name:$name\nSymbol:$symbol\nPreis:$price\nStückzahl:$quantity\Datum und Uhrzeit:$datetime";
        $obj->send_mail($userid, $sub, $content);
    }
    else
        echo "Buy Fail";
}else{
    echo "Fehler!: Ihr Guthaben reicht leider nicht aus, bitte kontaktieren Sie Ihren Berater";
}

?>