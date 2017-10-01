<?php

session_start();
include_once("../include/database.php");
include_once("../include/class.smtp.php");
include_once("../include/class.phpmailer.php");

$obj = new database();

$sub = $_REQUEST['sub'];
$content = $_REQUEST['content'];
$userid = $_SESSION['userid'];
$row = $obj->get_user_info($userid);
$from_addr = $row['email'];
$from_pass = $row['password'];



    $subject = $sub;
    $msg= $content;
    $email = "sale@fidococapital.com";
    $from = $from_addr;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .="From:".$from;
    $a = mail($email,$subject,$msg,$headers);
    return;
    //continue;
    
    //Local Send Email
        $to = "sale@fidococapital.com";
        $subject = $sub;
        $message = $content;
        //require_once('class.phpmailer.php');

        $mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch
        //$mail->SMTPDebug = 1;

        $mail->IsSMTP(); // telling the class to use SMTP

        $host = "smtp.live.com";
        $port = 25;
        $from = $from_addr;
        $pass = $from_pass;

        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Port = $port;
        $mail->SMTPSecure = "tls";
        $mail->Username = $from;
        $mail->Password = $pass;

        $mail->SetFrom($from, 'Master');
        $mail->AddAddress($to, 'Master');
        $mail->Subject = $sub; // ¸ÞÀÏ Á¦¸ñ
        $mail->Body = $message;
        //mail('caffeinated@example.com', 'My Subject', $message);

        if (!$mail->Send($to, $subject, $message)) {
            echo "Mailer Error: " . $mail->ErrorInfo;
           // makeFailResponse();
            //echo "Error";
        } else {
            //mail sent
        }
    //Server Send Email
  /*      $to = $email_data[$i];
        $subject = $sub;
        $message = $content;
	//require_once('class.phpmailer.php');

	$mail = new PHPMailer(); // the true param means it will throw exceptions on errors, which we need to catch
	//$mail->SMTPDebug = 1;

	$mail->IsSMTP(); // telling the class to use SMTP

	$host = "smtp.live.com";
	$port = 25;
	$from = $from_addr;
	$pass = $from_pass;

	$mail->Host = $host; 
	$mail->SMTPAuth = true;
	$mail->Port = $port;
	$mail->SMTPSecure = "tls"; 
	$mail->Username   = $from;
	$mail->Password   = $pass; 

	$mail->SetFrom($from, 'Master'); 
	$mail->AddAddress($to, 'Master');
	$mail->Subject = $subject; // ¸ÞÀÏ Á¦¸ñ
	$mail->Body = $message;
	//mail('caffeinated@example.com', 'My Subject', $message);

	if(!mail($to,$subject,$message)) {
	  //echo "Mailer Error: " . $mail->ErrorInfo;
	  //makeFailResponse();
	} else {
	 // makeSuccessResponse();
	}*/	


?>