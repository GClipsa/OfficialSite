<?php
require 'conndis_mysql.php';
include "geturlquery.php";

function getnewscontent()
{	
	$numpage = getUrlQuery('id');
	$firstresult = R::load('news', $numpage);
	$result = $firstresult->export();
	return $result;
}
?>