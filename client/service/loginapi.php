<?php

session_start();
include_once("../../include/database.php");
$obj = new database();

$type = $_REQUEST['type'];
if ($type == 'login') {
    $email = $_REQUEST['un'];
    $password = $_REQUEST['pw'];
    $row = $obj->agent_login($email, $password);
    if ($row) {
        $result = array();
        $result['status'] = 1;
        $result['message'] = 'Login Success';

        $role = $obj->role_data_id($row['role_id']);
        class E{
            var $pin_sales;
            var $pinless_sales;
            var $physical_sales;
            var $bill_payment;
            var $prepaid_registration;
            var $chat_with_telco;
            var $get_training_certificate;
            var $raisepo;
            var $payment;
            var $road_upload;
            var $report_activation;
            var $report_transaction;
            var $report_ordertracking;
            var $report_e_transaction;
            var $report_sales_manget_kpi;
            var $report_geo_tagging;
        }
        class D {

            var $name;
            var $address1;
            var $address2;
            var $state;
            var $state_name;
            var $region;
            var $region_name;
            var $pin;
            var $phonenumber;
            var $email;
            var $latitude;
            var $longitude;
            var $wallet_account;
            var $ipay88_accountid;
            var $iapy88_password;
            var $kpi_activations;
            var $kpi_revenues;
            var $dist_id;
            var $sub_dist_id;
            var $dealer_id;
            var $agent_id;
            var $role;
        }

        $d = new D();
        $d->name = $row['name'];
        $d->address1 = $row['address1'];
        $d->address2 = $row['address2'];
        $d->state = $row['state'];
        $d->state_name = $obj->state_data_id($row['state'])['state'];
        $d->region = $row['region'];
        $d->region_name = $obj->region_data_id($row['region'])['region'];
        $d->pin = $row['pin'];
        $d->phonenumber = $row['phonenumber'];
        $d->email = $row['email'];
        $d->latitude = $row['latitude'];
        $d->longitude = $row['longitude'];
        $d->wallet_account = $row['wallet_account'];
        $d->ipay88_accountid = $row['ipay88_accountid'];
        $d->ipay88_password = $row['ipay88_password'];
        $d->kpi_activations = $row['kpi_activations'];
        $d->kpi_revenues = $row['kpi_revenues'];
        $d->dist_id = $row['dist_id'];
        $d->sub_dist_id = $row['sub_dist_id'];
        $d->dealer_id = $row['dealer_id'];
        $d->agent_id = $row['agent_id'];
        $e = new E();
        $e->pin_sales = $role['pin_sales'];
        $e->pinless_sales = $role['pinless_sales'];
        $e->physical_sales = $role['physical_sales'];
        $e->bill_payment = $role['bill_payment'];
        $e->prepaid_registration = $role['prepaid_registration'];
        $e->chat_with_telco = $role['chat_with_telco'];
        $e->get_training_certificate = $role['get_training_certificate'];
        $e->raisepo = $role['raisepo'];
        $e->payment = $role['payment'];
        $e->road_upload = $role['road_upload'];
        $e->report_activation = $role['report_activation'];
        $e->report_transaction = $role['report_transaction'];
        $e->report_ordertracking = $role['report_ordertracking'];
        $e->report_e_transaction = $role['report_e_transaction'];
        $e->report_sales_manget_kpi = $role['report_sales_manget_kpi'];
        $e->report_geo_tagging = $role['report_geo_tagging'];
        
        $d->role = $e;
        $result['result'] = $d;
        echo json_encode($result);
    } else {
        $result = array();
        $result['status'] = 0;
        $result['message'] = "Login Fail. Check your Email and Password.";
        echo json_encode($result);
    }
}
?>
