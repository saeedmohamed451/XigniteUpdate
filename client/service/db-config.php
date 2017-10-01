<?php

$dbHost = "localhost";
$dbName = "telco_db";
$dbUser = "root";
$dbPassword = "";


function connectDB() {
		Global $dbHost, $dbName, $dbUser, $dbPassword;
                $con = mysql_connect($dbHost, $dbUser, $dbPassword) or die(mysql_error());
                // selecting database
                mysql_select_db($dbName) or die(mysql_error());
		mysql_query("set names 'utf8'");
		return $con;
	}

?>
