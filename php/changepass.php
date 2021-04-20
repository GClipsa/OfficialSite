<?php
require 'conndis_mysql.php';
if(isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['renewpassword']))
{
    $oldpassword = $_POST["oldpassword"];
	$newpassword = $_POST["newpassword"];
    $renewpassword = $_POST["renewpassword"];
    $login = $_SESSION['user']->login;
    $user = R::findOne('users', 'login = ?', array($login));
    if(!$user)
    {
        $error = "php0";
        header("Location: /pages/identification.php");
    }
    else if($oldpassword == "" || strlen($oldpassword) < 7 || strlen($oldpassword) > 25)
    {
        $error = "php1";
    }
	else if(!password_verify($login.$oldpassword, $user->password)){
		$error = "php1.1";
	}
    else if($newpassword == "" || strlen($newpassword) < 7 || strlen($newpassword) > 25)
    {
        $error = "php2";
    }
    else if($newpassword == $oldpassword)
    {
        $error = "php2.1";
    }
    else if($renewpassword != $newpassword)
    {
        $error = "php3";
    }
    else if($user->changepass)
    {
        $changepass = $user->changepass;
        $parts=explode(",",base64_decode($changepass));
        if(strtotime($parts[1]) > strtotime(date('Y-m-d H:i:s')))
        {
            $error = "php4";
        }
    }
    if($error != ""){

		echo(json_encode($error));
	}
	else{

        $userH = R::load('users', $user->id);
		$userH->password = password_hash($login.$newpassword, PASSWORD_DEFAULT);
        $t = strtotime('+5 minute');
		$cpass = substr(md5(time()), 0, 10);
		$cpass = base64_encode($cpass.date(',Y-m-d H:i:s',$t));
		$userH->changepass = $cpass;
		R::store($userH);

        unset($_SESSION['user']);
        setcookie('user', null, -1, '/');
        echo(json_encode("phpOK"));
    }
}
?>