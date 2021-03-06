<?php


//code
function IncodeToAES128($txt)
{
	$key = pack('H*', "bcz04b7e110a0cdrb54763051cef08bc");
	$iv = substr(md5(time()), 0, 16);

	$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $txt, MCRYPT_MODE_CBC, $iv);
	$ciphertext_base64 = base64_encode($ciphertext);
	$ciphertext_base64 = $iv.$ciphertext_base64;
	return $ciphertext_base64;
}

//decode
function DecodeFromAES128($ciphertext_base64)
{
	$key = pack('H*', "bcz04b7e110a0cdrb54763051cef08bc");
	$iv = substr(md5(time()), 0, 16);

	$iv = mb_substr($ciphertext_base64, 0, 16);
	$code = mb_substr($ciphertext_base64, 16, strlen($ciphertext_base64));
	$code = base64_decode($code);
	$decodetext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $code, MCRYPT_MODE_CBC, $iv);
	return $decodetext;
}
?>