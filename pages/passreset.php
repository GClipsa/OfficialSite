<?php
require '../php/conndis_mysql.php';
require	'../php/geturlquery.php';
require '../php/cookieverify.php';
$resetpass = getUrlQuery("token");
$resetcode = getUrlQuery("code");
// var_dump($resetpass);
$user = R::findOne('users', 'resetpass = ?', array($resetpass));
if($user == null)
{
	header("Location: /");
}
else
{
	$parts=explode(",",base64_decode($resetpass));
	if(strtotime($parts[1]) < strtotime(date('Y-m-d H:i:s')))
    {
        header("Location: /");
    }
}
?>
<!doctype html>
<HTML> 
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/passreset_mainbody.css">
<link rel="stylesheet" type="text/css" href="../css/modalwin.css">

<TITLE>GClipsa reseting password</TITLE> 
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
					<h1 class="welcome_text">Reseting Password</h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="reset_panel">
							<div class="reset_text">
								<p>PASSWORD RESET FORM</p>
							</div>
                            <div class="reset_code_warn"><p id="rcw">Some code warning for people.</p></div>
							<div class="reset_code">
								<img class="reset_code_pic" src="../svg/key.svg" alt="key.svg">
								<?php
								if($resetcode){
								?>
								<input type="text" id="Reset_code_text" placeholder="Your code from mail..." value="<?php echo $resetcode ?>">
								<?php
								}
								else
								{
								?>
								<input type="text" id="Reset_code_text" placeholder="Your code from mail..." value="">
								<?php
								}
								?>
							</div>
							<div class="reset_pass_warn"><p id="rpw">Some password warning for people.</p></div>
							<div class="reset_pass">
								<img class="reset_pass_pic" src="../svg/password.svg" alt="password.svg">
								<input type="password" id="Reset_pass_text" placeholder="Your new password...">
							</div>
							<div class="reset_repass_warn"><p id="rrw">Some password warning for people.</p></div>
							<div class="reset_repass">
								<img class="reset_repass_pic" src="../svg/password.svg" alt="password.svg">
								<input type="password" id="Reset_repass_text" placeholder="Repeat new password...">
							</div>
							<div class="reset_submit">
								<div class="reset_submit_btn" id="Reset_submit_btn"> <p id="Reset_submit_btn_p">CHANGE PASSWORD</p> </div>
							</div>
						</div>
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
<script type="module" src="../js/passreset_checker.js"></script>
<script type="module" src="../js/modalwin.js"></script>
</HTML>