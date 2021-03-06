<?php
function getuserinfo($id)
{
	$upuser = R::load( 'users', $id );
	return $upuser;
}
?>