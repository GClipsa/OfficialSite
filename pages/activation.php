<?php
require '../php/conndis_mysql.php';
require	'../php/geturlquery.php';
require '../php/cookieverify.php';
$token = getUrlQuery("token");
$checktoken = R::findOne('users', 'token = ?', array($token));
$datacc = 0;
if($checktoken == null)
{
	header("Location: /");
}
else
{
	
	$parts=explode(",",base64_decode($token));
	if(strtotime($parts[1]) > strtotime(date('Y-m-d H:i:s')))
	{
		$datacc = 1;
		$user = R::load( 'users', $checktoken->id);
		$user->token = '';
	    $user->verified = '1';
	    R::store( $user );
	}

}
?>
<!doctype html>
<HTML> 
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../images/gclipsa.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/activation_mainbody.css">

<TITLE>GClipsa Identification</TITLE> 
</HEAD> 
<BODY> 
	<div class="bg"></div>
	<div class="wrapper">
		<div class="top_panel">
			<div class="tp_imgbox">
				<img class="tp_imgbox_pic" src="../svg/gc.svg" alt="gc.svg">
				<p class="tp_imgbox_text">GCLIPSA</p>
			</div>
			<div class="tp_menu">
				<div class="tp_menu_buff">
					<ul class="tp_menu_ul">
						<li><a href="../index.php">Main</a></li>
						<li><a href="news.php">News</a></li>
						<li class="sofware_li"><a href="software.php">Software</a><!-- pages/software.php -->
							<ul class="dropdown">
								<a href="software.php"><li>all projects</li></a>
								<a href="#"><li>For streams</li></a>
								<a href="#"><li>Bots & automation</li></a>
							</ul>
						</li>
						<?php if($username == null) { ?>
						<li><a href="identification.php">My cabinet</a></li>
						<?php 
						} 
						else { ?>
						<li><a href="mycabinet.php"><?php echo $username ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="tp_burg-lines">
				<span></span>
			</div>
		</div>
		<div class="rp_menu-burg" id="Rp_menu-burg">
			<ul class="rp_menu-burg_ul">
				<li><a href="../index.php">Main</a></li>
				<li><a href="news.php">News</a></li>
				<li class="mob_sofware_li"><a href="#">Software</a></li>
				<ul class="mob_dropdown">
					<li><a href="software.php">all projects</a></li>
					<li><a href="#">For streams</a></li>
					<li><a href="#">Bots & automation</a></li>
				</ul>
				<?php if($username == null) { ?>
				<li><a href="identification.php">My cabinet</a></li>
				<?php 
				} 
				else { ?>
				<li><a href="mycabinet.php"><?php echo $username ?></a></li>
				<?php } ?>
			</ul>
		</div>

		<div class="main_body">
			<div class="container1">
				<div class="welcome_box">
					<h1 class="welcome_text">Activation email</h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<?php 
						if($datacc == 1){
						?>
						<p class="сongratulations">Congratulations, you have successfully verified your email on our website.</p>
						<?php
						} 
						else if($datacc == 0){
						?>
						<p class="сongratulations">Sorry, but this link is out of date. To confirm your email, go to your profile and request it again.</p>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="prefooter">
			<p></p>
		</div>
		<div class="footer">
			<p> &copy; GCLIPSA / 2021 </p>
		</div>
	</div>
</BODY>
<!-- JS -->
<script src="../js/jquery.js"></script>
<script src="../js/burgmenu.js"></script>
</HTML>