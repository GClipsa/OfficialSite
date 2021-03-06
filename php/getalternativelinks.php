<?php
function getalternativelinks($request)
{	
	$result = R::getCol($request);
	return $result;
}
?>