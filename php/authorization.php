<?php
require 'conndis_mysql.php';

if(isset($_POST['login']) && isset($_POST['password']))
{
	$login = strtolower($_POST["login"]);
	$password = $_POST["password"];

	$user = R::findOne('users', 'login = ?', array($login));
	$error = "";
	if(strlen($login) < 5 || strlen($login) > 25){
		$error = "php1";
	}
	else if($user == null)
	{
		$error = "php1.1";
	}
	else if($password == "" || strlen($password) < 7 || strlen($password) > 25){
		$error = "php2";
	}
	else if(!password_verify($login.$password, $user->password)){
		$error = "php2.1";
	}

	if($error != ""){
		echo(json_encode($error));
	}
	else{
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$useragent = md5($useragent);
		
		$hashguard = password_hash($useragent.'%'.$ip, PASSWORD_DEFAULT);

		$userH = R::load('users', $user->id);
		$userH->hashguard = $hashguard;
		R::store($userH);

		$msuser=array("id"=>$user->id, "login"=>$user->login);

		$userobj = R::convertToBean('user',$msuser);

		$_SESSION['user'] = $userobj;

		setcookie('user', serialize($userobj), time()+3600*24, '/');

		echo(json_encode("phpOK"));
	}
}

?>