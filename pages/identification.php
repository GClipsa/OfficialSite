<?php
	require '../php/conndis_mysql.php';
	require '../php/lang_identify_funcs.php';

	$ml_headers = lang_ml_header();
	$ml_header = $ml_headers[0];
	$ml_header_link = $ml_headers[1];
	$lang = $ml_headers[2];

	// var_dump($_SESSION['user']);
	// var_dump(session_id());
	unset($_SESSION['user']);
	setcookie('user', null, -1, '/');
?>
<!doctype html>
<HTML lang = "<?php echo $lang ?>">
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">
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
			<select class="lang_select" id="Lang_select">
					<option value="ru"<?php if($lang == "ru") echo "selected"?>>RU</option>
					<option value="en" <?php if($lang == "en") echo "selected"?>>EN</option>
			</select>
			<div class="tp_menu">
				<div class="tp_menu_buff">
					<ul class="tp_menu_ul">
						<li><a href="<?php echo $ml_header_link["tp_menu_main"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_main"] ?></a></li>
						<li><a href="<?php echo $ml_header_link["tp_menu_news"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_news"] ?></a></li>
						<li class="sofware_li"><a href="<?php echo $ml_header_link["tp_menu_services"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_services"] ?></a><!-- pages/software.php -->
							<ul class="dropdown">
								<a href="<?php echo $ml_header_link["tp_menu_allprojects"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><li><?php echo $ml_header["tp_menu_allprojects"] ?></li></a>
								<a href="<?php echo $ml_header_link["tp_menu_orderproject"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><li><?php echo $ml_header["tp_menu_orderproject"] ?></li></a>
								<!-- <a href="#"><li>Bots & automation</li></a> -->
							</ul>
						</li>
						<?php if($username == null) { ?>
						<li><a href="<?php echo $ml_header_link["tp_menu_identification"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_identification"] ?></a></li>
						<?php 
						} 
						else { ?>
						<li><a href="<?php echo $ml_header_link["tp_menu_mycabinet"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $username ?></a></li>
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
				<li><a href="<?php echo $ml_header_link["tp_menu_main"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_main"] ?></a></li>
				<li><a href="<?php echo $ml_header_link["tp_menu_news"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_news"] ?></a></li>
				<li class="mob_sofware_li"><a href="#"><?php echo $ml_header["tp_menu_services"] ?></a></li>
				<ul class="mob_dropdown">
					<li><a href="<?php echo $ml_header_link["tp_menu_allprojects"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_allprojects"] ?></a></li>
					<li><a href="<?php echo $ml_header_link["tp_menu_orderproject"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_orderproject"] ?></a></li>
					<!-- <li><a href="#">Bots & automation</a></li> -->
				</ul>
				<?php if($username == null) { ?>
					<li><a href="<?php echo $ml_header_link["tp_menu_identification"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_identification"] ?></a></li>
				<?php 
				} 
				else { ?>
				<li><a href="<?php echo $ml_header_link["tp_menu_mycabinet"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $username ?></a></li>
				<?php } ?>
				<li><select class="lang_select_burg" id="Lang_select_burg">
					<option value="ru"<?php if($lang == "ru") echo "selected"?>>LANGUAGE: RU</option>
					<option value="en" <?php if($lang == "en") echo "selected"?>>LANGUAGE: EN</option>
				</select></li>
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
								<div class="forget_submit_btn auth_submit_btn" id="Forget_submit_btn"> <p id="Forget_submit_btn_p">SEND INSTRUCTIONS</p> </div>
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
<script src="../js/mod_url_params.js"></script>
<script src="../js/langchangelistener.js"></script>
</HTML>