<?php

session_start();
include_once("../include/database.php");
$obj = new database();
$name = $_REQUEST['name'];
$symbol = $_REQUEST['symbol'];
$change = $_REQUEST['change'];
$datetime = $_REQUEST['datetime'];
$quantity = $_REQUEST['quantity'];
$price = $_REQUEST['price'];
$userid = $_SESSION['userid'];
$buy_id = $_REQUEST['id'];
$cur_price = $_REQUEST['cur_price'];
$cur_quantity = $_REQUEST['cur_quantity'];

if( $cur_quantity > $quantity ){
    echo "Sie haben nicht genügen Aktien um diesen verkauf erfolgreich auszuführen";
}else{
    $obj->sell_product($userid, $buy_id, $symbol, $name, $change, $datetime, $cur_quantity, $cur_price, $quantity, $price);
    
        $rw = $obj->get_user_info($userid);
        $user_name = $rw['name'];
        $user_email = $rw['email'];
        $sub = "$user_name($user_email) verkaufen";
        $content = "Name:$name\nSymbol:$symbol\nPreis:$price\nStückzahl:$quantity\Datum und Uhrzeit:$datetime";
        $obj->send_mail($userid, $sub, $content);
        
    echo "Erfolgreich verkauft, Verkaufserlös wurde erfolgreich Ihrem Konto gutgeschrieben";
}


?>