<?php
	require_once 'db-config.php';

	function connectDB() {
		Global $dbHost, $dbName, $dbUser, $dbPassword;
                $con = mysql_connect($dbHost, $dbUser, $dbPassword) or die(mysql_error());
                // selecting database
                mysql_select_db($dbName) or die(mysql_error());
		mysql_query("set names 'utf8'");
		return $con;
	}
        
        function login($username ,$password){
            $con = connectDB();
            $query = "select * from telco_agent where name = '$username' and password = '$password'";
            
            $res = mysql_query($query);
            $response = array();
            
            if( $row = mysql_fetch_object($res) ){
                $response['result'] = 'true';
                
                $data = array();
                $data['userid'] = $row->id;
                $data['name'] = $row->name;
                $data['address'] = $row->address;
                $response['message'] = $data;
            }
           else{
                $response['result'] = 'false';
                $response['message'] = 'You are Unregisterd.<br>Try to input correct Information';
            }
            return json_encode($response);
        }
        
        function getUserInfo($user_id){
            $con = connectDB();
            $query = "select * from telco_agent where id = '$user_id'";
            $res = mysql_query($query);
            $row = mysql_fetch_object($res);
            $data = array();
            $data['id'] = $row->id;
            $data['name'] = $row->name;
            $data['address'] = $row->address;
            $data['balance'] = $row->balance;
            return json_encode($data);
        }
        
        function SaveHistory($reload, $phoneno, $date, $type){
            $con = connectDB();
            $query = "insert into agent_sale_history(amount, phoneno, time, type) values('$reload', '$phoneno', '$date', '$type')";
            mysql_query($query);
        }
        function UpdateBalance($id, $balance){
            $con = connectDB();
            $query = "update telco_agent set balance = '$balance' where id = '$id'";
            mysql_query($query);
        }
        
        function getVoucher($number){
            $con = connectDB();
            $query = "select * from voucher_table where number='$number'";
            $res = mysql_query($query);
            return ($row = mysql_fetch_object($res)) ? true : false;
        }
        function SaveVoucherHistory($reload, $phoneno, $voucher, $date){
            $con = connectDB();
            $query = "insert into voucher_history(amount, phoneno, time, voucher_number) values('$reload', '$phoneno', '$date', '$voucher')";
            mysql_query($query);
        }
        
        function getAllOperator(){
            $con = connectDB();
            $sql = "select name from operator_table";
            $res = mysql_query($sql);
            $result = array();
            while( $row = mysql_fetch_object($res) ){
                $result[] = $row->name;
            }
            return $result;
        }
        
        function AddCustomer($name, $passport, $sex, $race, $address, $phoneno, $email, $serverUrl){
            $con = connectDB();
            $sql = "insert into customer_table(name, passport, sex, race, address, phoneno, email, signature) values('$name', '$passport',"
                    . "'$sex', '$race', '$address', '$phoneno', '$email', '$serverUrl')";
            mysql_query($sql);
        }
        function isExistCustomer($passport){
            $con = connectDB();
            $sql = "select * from customer_table where passport = '$passport'";
            $res = mysql_query($sql);
            return ($row = mysql_fetch_object($res)) ? true : false;
        }
        
        function addMsg($sender, $msg, $time){
            $con = connectDB();
            $sql = "insert into chattable(sender, receiver, message, time) values('$sender', 'telco', '$msg', '$time')";
            mysql_query($sql);
        }
        function getMsg($sender, $time){
            $con = connectDB();
            $sql = "select sender, message, time from chattable where (sender = '$sender' or receiver = 'all') and time > '$time' order by time asc";
            
            $res = mysql_query($sql);
            $result = array();
            class T{
                var $name = "";
                var $content = "";
                var $time = "";
            }
                while( ($row = mysql_fetch_object($res)) ){
                     $t = new T();
                     $t->name = $row->sender;
                     $t->content = $row->message;
                     $t->time = $row->time;
                     if( $row->time != null )
                        $result[] = $t;
                }
            
            $resArray = array();
            $resArray['res'] = $result;
            return json_encode($result);
        }
?>