<?php
function getuserorders($login)
{
	$orders = R::find( 'orders', 'login = ?', array($login) );
	return $orders;
}
function getnumberalluserorders($login)
{
	$numbers = R::count('orders', 'login = ?', array($login));
	return $numbers;
}
?>