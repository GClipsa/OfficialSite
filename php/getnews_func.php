<?php
// require 'conndis_mysql.php';

function getnews_func($number, $colvo)
{	
	$num = intval($number)*$colvo;
	$firstnum = ($num-$colvo)+1;
	$result = R::find('prenews', 'id >= ? AND id <= ?', array($firstnum, $num));
	$fullarr = R::exportAll($result);
	return $fullarr;
}
?>