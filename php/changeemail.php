<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'conndis_mysql.php';

if(isset($_POST['password']) && isset($_POST['newemail']) && isset($_POST['renewmail']))
{
    $password = $_POST["password"];
	$newemail = strtolower($_POST["newemail"]);
    $renewmail = strtolower($_POST["renewmail"]);
    $login = $_SESSION['user']->login;
    $user = R::findOne('users', 'login = ?', array($login));
    $oldemail = $user->email;

    if(!$user)
    {
        $error = "php0";
        header("Location: /pages/identification.php");
    }
    else if($password == "" || strlen($password) < 7 || strlen($password) > 25)
    {
        $error = "php1";
    }
	else if(!password_verify($login.$password, $user->password)){
		$error = "php1.1";
	}
    else if(!filter_var($newemail, FILTER_VALIDATE_EMAIL) || strlen($newemail) > 75){
		$error = "php2";
	}
	else if($renewmail == "" || $renewmail != $newemail){
		$error = "php3";
	}
    else if($user->changeemail != "")
    {
        $changemail = $user->changeemail;
        $parts=explode(",",base64_decode($changemail));
        if(strtotime($parts[1]) > strtotime(date('Y-m-d H:i:s')))
        {
            $error = "php4";
        }
    }
    else if($oldemail == $newemail){
		$error = "php5";
	}
    if($error != ""){

		echo(json_encode($error));
	}
	else{
        FunctionName($user, $newemail, $oldemail);
    }
}

function FunctionName($user, $newemail, $oldemail)
    {
        $Tuser = R::load( 'users', $user->id);
        $t = strtotime('+1 day');
        $tok = substr(md5(time()), 0, 10);
        $tok = base64_encode($tok.date(',Y-m-d H:i:s,',$t).$newemail);
        $Tuser->changeemail = $tok;
        R::store( $Tuser );
        
        $email = $newemail;

        $mailmess = "
        Greetings from GClipsa, you have just submitted an application to change your current email (".$oldemail.") to a new one (".$newemail."), in order to finally change and confirm the change of email, you must click on the 'Change email' button located at the bottom of this text.<br><br>
            <div><!--[if mso]>
            <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:36px;v-text-anchor:middle;width:200px;' arcsize='50%' strokecolor='#e6e6e8' fillcolor='#ff9b8f'>
            <w:anchorlock/>
            <center style='color:#2f353e;font-family:sans-serif;font-size:13px;font-weight:bold;'>Change email</center>
            </v:roundrect>
            <![endif]--><a href='https://gclipsa.com/pages/activation?chmail=".$tok."'
            style='background-color:#ff9b8f;border:1px solid #e6e6e8;border-radius:18px;color:#2f353e;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:36px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;'>Change email</a></div>
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
        $mail->FromName = 'GClipsa security';
        $mail->addAddress($email);               // Name is optional
        $mail->addReplyTo('security@gclipsa.com', 'GClipsa security');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'GClipsa - changing and confirmation a new email.';
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
?>