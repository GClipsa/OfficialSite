<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'conndis_mysql.php';

function FunctionName($user, $lang)
    {
        $Tuser = R::load( 'users', $user->id);
        $t = strtotime('+1 day');
        $tok = substr(md5(time()), 0, 10);
        $tok = base64_encode($tok.date(',Y-m-d H:i:s',$t));
        $Tuser->token = $tok;
        R::store( $Tuser );
        
        $email = $user->email;

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
        $mail->FromName = 'GClipsa security';
        $mail->addAddress($email);               // Name is optional
        $mail->addReplyTo('security@gclipsa.com', 'GClipsa security');

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

if(isset($_POST['data']))
{
    if(isset($_POST['lang'])){$lang = $_POST["lang"];}else{$lang = "en";}
    $user = R::findOne('users', 'login = ?', array($_SESSION['user']->login));
    if(!$user)
    {
        echo(json_encode("php1"));
    }
    else if($user->verified == 0)
    {
        if($user->token != "")
        {
            $uptime = explode(",",base64_decode($user->token));
            if(strtotime($uptime[1]) > strtotime(date('Y-m-d H:i:s')))
            {
                $error = "php2";
                echo(json_encode($error));
            }
            else
            {
                FunctionName($user, $lang);
            }
        }
        else
        {
            FunctionName($user, $lang);
        }
    }
}
?>