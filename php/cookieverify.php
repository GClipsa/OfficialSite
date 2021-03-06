<?php
// var_dump($_SESSION['user']);
// var_dump($_COOKIE['user']);
// var_dump(session_id());

// var_dump($ip);
// var_dump($useragent);
if(!isset($_SESSION['user']) && isset($_COOKIE['user']))
{
	$usercookie = unserialize($_COOKIE['user']);

	$user = R::findOne('users', 'login = ?', array($usercookie->login));
	if($user != null)
	{
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$useragent = md5($useragent);
		$ip = $_SERVER['REMOTE_ADDR'];

		$prevhashguard = $user->hashguard;
		$hashguard = $useragent.'%'.$ip;

		if(password_verify($hashguard, $prevhashguard))
		{
			$_SESSION['user'] = $usercookie;
			$username = $_SESSION['user']->login;
		}
		else
		{
			header("Location: /pages/identification.php");
		}
	}
	else
	{
		header("Location: /pages/identification.php");
	}
}
else if (isset($_SESSION['user']))
{
	$login = $_SESSION['user']->login;
	$user = R::findOne('users', 'login = ?', array($login));
	if($user != null)
	{
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$useragent = md5($useragent);
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$prevhashguard = $user->hashguard;
		$hashguard = $useragent.'%'.$ip;

		if(password_verify($hashguard, $prevhashguard))
		{
			$username = $_SESSION['user']->login;
		}
		else
		{
			header("Location: /pages/identification.php");
		}
	}
	else
	{
		header("Location: /pages/identification.php");
	}
}
?>