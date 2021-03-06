<?php
require 'conndis_mysql.php';

function getsoftwarenames()
{	
	$result = R::getCol('SELECT name FROM presoftware');
	return $result;
}

if(isset($_POST['program']))
{
	$name = $_POST["program"];
	$result = R::find('presoftware', 'name = ?', array($name));
	$fullarr = R::exportAll($result);
	echo json_encode($fullarr);
}

function getpop()
{	
	$result = R::findAll('presoftware','ORDER BY rating LIMIT 4');
	return $result;
}
?>