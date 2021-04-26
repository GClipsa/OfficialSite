<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'conndis_mysql.php';
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

if(isset($_POST['email']))
{
    $email = $_POST["email"];

	if(isset($_POST['lang'])){$lang = $_POST["lang"];}else{$lang = "en";}

	$user = R::findOne('users', 'email = ?', array($email));
	$error = "";
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 75){
		$error = "php1";
	}
	else if($user == null)
	{
		$error = "php2";
	}
	else if($user != null)
	{
        if($user->resetpass)
        {
            $resetpass = $user->resetpass;
            $parts=explode(",",base64_decode($resetpass));
            if(strtotime($parts[1]) > strtotime(date('Y-m-d H:i:s')))
            {
                $error = "php3";
            }
        }
	}

    if($error != ""){
		echo(json_encode($error));
	}
    else
	{
        $t = strtotime('+1 hour');
		$rpass = substr(md5(time()), 0, 10);
		$rpass = base64_encode($rpass.date(',Y-m-d H:i:s',$t));

		$rcode = substr(md5($user->login.time()), 0, 15);

		$user = R::load( 'users', $user->id);
		$user->resetpass = $rpass;
		$user->resetcode = $rcode;
	    R::store( $user );

        $mailmess = "Hello, you just requested a password recovery for your account on the gclipsa.com website, if you didn’t do it, do not take any further action, you can simply delete this message.
		If it is you who sent the request, please click on the button below to change the password for your account.<br><br>
		<div><!--[if mso]>
  <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:36px;v-text-anchor:middle;width:200px;' arcsize='50%' strokecolor='#e6e6e8' fillcolor='#ff9b8f'>
    <w:anchorlock/>
    <center style='color:#2f353e;font-family:sans-serif;font-size:13px;font-weight:bold;'>Reset password</center>
  </v:roundrect>
<![endif]--><a href='https://gclipsa.com/pages/passreset?token=".$rpass."&"."code=".$rcode."&lang=".$lang."'
style='background-color:#ff9b8f;border:1px solid #e6e6e8;border-radius:18px;color:#2f353e;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:36px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;'>Reset password</a></div>
		<br><br>This link will be available within 1 hour.";
		
		$mail = new PHPMailer();
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 's25.tuthost.com';  // Specify main and backup SMTP servers
		$mail->CharSet = 'UTF-8';
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'security@gclipsa.com';                 // SMTP username
		$mail->Password = 'q1siQmGPB';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

		$mail->From = 'security@gclipsa.com';
		$mail->FromName = 'GClipsa security';
		$mail->addAddress($email);               // Name is optional
		$mail->addReplyTo('security@gclipsa.com', 'GClipsa security');

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'GClipsa - password reseting.';
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