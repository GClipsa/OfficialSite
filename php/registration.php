<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'conndis_mysql.php';
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword']))
{
	$login = strtolower($_POST["login"]);
	$email = strtolower($_POST["email"]);
	$password = $_POST["password"];
	$repassword = $_POST["repassword"];

	if(isset($_POST['lang'])){$lang = $_POST["lang"];}else{$lang = "en";}

	$checkmail = R::find('users', 'email = ?', array($email));
	$checklogin = R::find('users', 'login = ?', array($login));
	$error = "";
	if(strlen($login) < 5 || strlen($login) > 25){
		$error = "php1";
	}
	else if($checklogin != null)
	{
		$error = "php1.1";
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 75){
		$error = "php2";
	}
	else if($checkmail != null)
	{
		$error = "php2.1";
	}
	else if($password == "" || strlen($password) < 7 || strlen($password) > 25){
		$error = "php3";
	}
	else if($repassword == "" || $repassword != $password){
		$error = "php4";
	}
	if($error != ""){

		echo(json_encode($error));
	}
	else{
		$date = date("y-m-d");
		$t = strtotime('+1 day');
		$tok = substr(md5(time()), 0, 10);
		$tok = base64_encode($tok.date(',Y-m-d H:i:s',$t));
		$user = R::dispense('users');
		$user->login = $login;
		$user->email = $email;
		$user->password = password_hash($login.$password, PASSWORD_DEFAULT);
		$user->token = $tok;
		$user->status = 'client';
		$user->date = $date;
		R::store($user);

			$mailmess = "Welcome to GClipsa, we are creating best software for you!<br>Please confirm this email on our site (gclipsa.com), click on the button below for successful registration.<br><br>
			<div><!--[if mso]>
	  <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:36px;v-text-anchor:middle;width:200px;' arcsize='50%' strokecolor='#e6e6e8' fillcolor='#ff9b8f'>
		<w:anchorlock/>
		<center style='color:#2f353e;font-family:sans-serif;font-size:13px;font-weight:bold;'>Confirm email</center>
	  </v:roundrect>
	<![endif]--><a href='https://gclipsa.com/pages/activation?token=".$tok."&lang=".$lang."'
	style='background-color:#ff9b8f;border:1px solid #e6e6e8;border-radius:18px;color:#2f353e;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:36px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;'>Confirm email</a></div>
			<br><br>This link will be available within 24 hours.";
		
		$mail = new PHPMailer();
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 's25.tuthost.com';  // Specify main and backup SMTP servers
		$mail->CharSet = 'UTF-8';
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'security@gclipsa.com';                 // SMTP username
		$mail->Password = 'q1siQmGPB';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

		$mail->From = 'security@gclipsa.com';
		$mail->FromName = 'GClipsa Security';
		$mail->addAddress($email);               // Name is optional
		$mail->addReplyTo('security@gclipsa.com', 'GClipsa Security');

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'GClipsa - email confirmation.';
		$mail->Body    = $mailmess;

		$mailerr="";
		if(!$mail->send()) {
		    $mailerr = "error";
		} else {
		    $mailerr = "ok";
		}
		if($mailerr == "error")
		{
			echo(json_encode("mailerr"));
		}
		else if($mailerr == "ok")
		{
			echo(json_encode("phpOK"));
		}
	}
}
?>