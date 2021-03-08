<?php
require 'conndis_mysql.php';

if(isset($_POST['code']) && isset($_POST['password']) && isset($_POST['repassword']))
{
    $code = strtolower($_POST["code"]);
	$password = $_POST["password"];
    $repassword = $_POST["repassword"];

    $user = R::findOne('users', 'resetcode = ?', array($code));
    $error = "";
    if(!$user)
    {
        $error = "php1";
    }
    else if($password == "" || strlen($password) < 7 || strlen($password) > 25){
		$error = "php2";
	}
	else if($repassword == "" || $repassword != $password){
		$error = "php3";
	}

    if($error != "")
    {
		echo(json_encode($error));
	}
    else
    {
        $userR = R::load('users', $user->id);
		$userR->password = password_hash($user->login.$password, PASSWORD_DEFAULT);
        $userR->resetpass = '';
        $userR->resetcode = '';
		R::store($userR);
        echo(json_encode("phpOK"));
    }
	
}
?>