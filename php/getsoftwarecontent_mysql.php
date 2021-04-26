<?php
require 'conndis_mysql.php';
require_once "geturlquery.php";

function getsoftwarecontent()
{	
	$numpage = getUrlQuery('id');
	$firstresult = R::load('software', $numpage);
	$result = $firstresult->export();
	return $result;
}
?>