<?php
require 'conndis_mysql.php';
if(isset($_POST['number']) && isset($_POST['colvo']))
{
	$colvo = intval($_POST['colvo']);
	$num = intval($_POST["number"])*$colvo;
	$firstnum = ($num-$colvo)+1;
	$result = R::find('prenews', 'id >= ? AND id <= ?', array($firstnum, $num));
	$fullarr = R::exportAll($result);
	
	$_SESSION['newspage'] = intval($_POST["number"]);

	echo json_encode($fullarr);
}
?>