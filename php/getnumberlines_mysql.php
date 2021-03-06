<?php
require 'conndis_mysql.php';
function getnumberlines($table)
{
	$lines = R::count($table);
	return $lines;
}
?>