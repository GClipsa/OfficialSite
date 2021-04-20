<?php
function getUrlQuery($key = null)
{	
	$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$parts = parse_url($url); 
	if (!empty($parts['query'])) {
		parse_str($parts['query'], $query); 
		if (is_null($key)) {
			return $query;
		} elseif (isset($query[$key])) {
			return $query[$key];
		}        
	}
	return null;
}
?>