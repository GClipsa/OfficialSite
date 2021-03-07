<?php
	require '../php/conndis_mysql.php';
	// var_dump($_SESSION['user']);
	// var_dump(session_id());
	unset($_SESSION['user']);
	setcookie('user', null, -1, '/');
?>
<!doctype html>
<HTML> 
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../images/gclipsa.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/identification_mainbody.css">
<link rel="stylesheet" type="text/css" href="../css/modalwin.css">

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
					<h1 class="welcome_text">identification panel</h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="panel_choose" id="Panel_choose">
							<div class="choose_text">
								<p>CHOOSE YOUR VARIANT</p>
							</div>
							<div class="variant">
								<div class="auth" id="Auth">
									<p>AUTHORIZATION</p>
									<img class="auth_pic" src="../svg/login.svg" alt="auth.svg">
								</div>
								<div class="reg" id="Reg">
									<p>REGISTRATION</p>
									<img class="reg_pic" src="../svg/register.svg" alt="reg.svg">
								</div>
							</div>
						</div>
						<div class="auth_panel" id="Auth_panel">
							<div class="auth_text">
								<img class="auth_text_pic" id="Auth_text_pic" src="../svg/back.svg" alt="back.svg">
								<p>AUTHORIZATION FORM</p>
							</div>
							<div class="auth_login_warn"><p id="alw">Some login warning for people.</p></div>
							<div class="auth_login">
								<img class="auth_login_pic" src="../svg/username.svg" alt="username.svg">
								<input type="text" id="Auth_login_text" placeholder="Your login...">
							</div>
							<div class="auth_pass_warn"><p id="apw">Some password warning for people.</p></div>
							<div class="auth_pass">
								<img class="auth_pass_pic" src="../svg/password.svg" alt="password.svg">
								<input type="password" id="Auth_password_text" placeholder="Your password...">
							</div>
							<div class="auth_submit">
								<div class="auth_submit_btn" id="Auth_submit_btn"> <p id="Auth_submit_btn_p">SING IN</p> </div>
							</div>
							<div class="auth_forget">
								<div class="forget_pass" id="Forget_pass"> <p>FORGET PASSWORD</p> </div>
							</div>
						</div>
						<div class="reg_panel" id="Reg_panel">
							<div class="reg_text">
								<img class="reg_text_pic" id="Reg_text_pic" src="../svg/back.svg" alt="back.svg">
								<p>REGISTRATION FORM</p>
							</div>
							<div class="reg_login_warn"><p id="rlw">Some login warning for people.</p></div>
							<div class="reg_login">
								<img class="reg_login_pic" src="../svg/username.svg" alt="username.svg">
								<input type="text" id="Reg_login_text" placeholder="Your login...">
							</div>
							<div class="reg_email_warn"><p id="rew">Some email warning for people.</p></div>
							<div class="reg_email">
								<img class="reg_pass_pic" src="../svg/email.svg" alt="email.svg">
								<input type="text" id="Reg_email_text" placeholder="Your email...">
							</div>
							<div class="reg_pass_warn"><p id="rpw">Some password warning for people.</p></div>
							<div class="reg_pass">
								<img class="reg_pass_pic" src="../svg/password.svg" alt="password.svg">
								<input type="password" id="Reg_password_text" placeholder="Your password...">
							</div>
							<div class="reg_repass_warn"><p id="rrw">Some repassword warning for people.</p></div>
							<div class="reg_repass">
								<img class="reg_repass_pic" src="../svg/password.svg" alt="password.svg">
								<input type="password" id="Reg_repassword_text" placeholder="Repeat your password...">
							</div>
							<div class="reg_submit">
								<div class="reg_submit_btn" id="Reg_submit_btn"> <p id="Reg_submit_btn_p">SING UP</p> </div>
							</div>
						</div>
						<div class="forget_panel auth_panel" id="Forget_panel">
							<div class="forget_text auth_text">
								<img class="forget_text_pic auth_text_pic" id="Forget_text_pic" src="../svg/back.svg" alt="back.svg">
								<p>FORGET PASSWORD FORM</p>
							</div>
							<div class="forget_email_warn auth_login_warn"><p id="flw">Some forget warning for people.</p></div>
							<div class="forget_email auth_login">
								<img class="forget_email_pic auth_login_pic" src="../svg/email.svg" alt="email.svg">
								<input type="text" id="Forget_email_text" placeholder="Your email...">
							</div>
							<div class="forget_submit auth_submit">
								<div class="forget_submit_btn auth_submit_btn" id="Forget_submit_btn"> <p>SEND PASSWORD</p> </div>
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
<script src="../js/identification_changer.js"></script>
<script type="module" src="../js/identification_checker.js"></script>
<script type="module" src="../js/modalwin.js"></script>
</HTML>