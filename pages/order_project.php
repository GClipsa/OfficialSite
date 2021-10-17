<?php
	require '../php/conndis_mysql.php';
	require '../php/getuserinfo.php';
	require '../php/getuserorders.php';
	require '../php/cookieverify.php';
	require '../php/lang_identify_funcs.php';

	$ml_headers = lang_ml_header();
	$ml_header = $ml_headers[0];
	$ml_header_link = $ml_headers[1];
	$lang = $ml_headers[2];

	// if($_SESSION['user'])
	// {
	// 	$userinfo = getuserinfo($_SESSION['user']->id);
	// 	$userorders = getuserorders($username);
	// 	$numbers = getnumberalluserorders($username);
	// }else{header("Location: /pages/identification.php");}
?>
<!doctype html>
<HTML lang = "<?php echo $lang ?>">
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/order_project_mainbody.css">
<link rel="stylesheet" type="text/css" href="../css/toast.css">
<link rel="stylesheet" type="text/css" href="../css/tooltip.css">
<link rel="stylesheet" type="text/css" href="../css/modalwin.css">
<link rel="stylesheet" type="text/css" href="../css/dropdownlist.css">
<link rel="stylesheet" type="text/css" href="../css/upload.css">
<TITLE>GClipsa Order Project</TITLE> 
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
					<h1 class="welcome_text">ORDER PROJECT</h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
                        <div class="form_box">
							<div class="form_header">
								<p>ORDER PROJECT FORM</p>
							</div>
							<div class="login">
								<div class="login_warn"><p id="flw">Some password warning for people.</p></div>
								<div class="login_box">
									<img src="../svg/user.svg" alt="user.svg">
									<input id="Login_text" placeholder="Your login...">
								</div>
							</div>
							<div class="email">
								<div class="email_warn"><p id="few">Some password warning for people.</p></div>
								<div class="email_box">
									<img src="../svg/email.svg" alt="email.svg">
									<input id="Email_text" placeholder="Your email...">
								</div>
							</div>
							<div class="dropper">
								<img src="../svg/dropdown.svg" alt="dropdown.svg">
								<div class="drop_box drop_box_type">
									<select>
										<option value="0">Choose type of order... </option>
										<option value="1">Program</option>
										<option value="2">Web site</option>
									</select>
								</div>
							</div>
							<div class="describe">
								<div class="describe_warn"><p id="fdw">Some password warning for people.</p></div>
								<div class="describe_box">
									<img src="../svg/describe.svg" alt="describe.svg">
									<textarea id="Describe_text" placeholder="Describe your idea, the information you need, how the project should be done, etc. To make it easier for us to evaluate and understand your order..."></textarea>
								</div>
							</div>
							<div class="social">
								<div class="social_prebox">
									<img src="../svg/social.svg" alt="social.svg"/>
									<div class="social_box">
										<div class="info_text">
											<p>If you want you can send us any your contacts in social media for better and fast communication.</p>
										</div>
										<div class="text_box">
											<img src="../svg/telegram.svg" alt="telegram.svg">
											<input id="Telegram_text" placeholder="Your telegram">
										</div>
										<div class="text_box">
											<img src="../svg/viber.svg" alt="viber.svg">
											<input id="Viber_text" placeholder="Your viber">
										</div>
									</div>
								</div>
							</div>
							<div class="dragdrop">
								<img src="../svg/upload.svg" alt="upload.svg">
								<div class="dragdrop_prebox">
									<div class="info_text">
										<p>Send us files that will help us make it faster and better.</p>
									</div>
									<div class="dragdrop_box">

									</div>
									<div id="Dragdrop_files">

									</div>
								</div>
							</div>
							<div class="sendorder">
								<img src="../svg/send.svg" alt="send.svg">
								<div class="s_button" id="S_button">
									<p>send order to gclipsa</p>
								</div>
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
<script src="../js/tooltip.js"></script>
<script src="../js/opacAnimating.js"></script>
<script src="../js/toast.js"></script>
<script type="module" src="../js/modalwin.js"></script>
<script type="module" src="../js/order_project.js"></script>
<script src="../js/mod_url_params.js"></script>
<script src="../js/langchangelistener.js"></script>
<script src="../js/dropdownlist.js"></script>
<script src="../js/core.js"></script>
<script src="../js/upload.js"></script>
</HTML>
