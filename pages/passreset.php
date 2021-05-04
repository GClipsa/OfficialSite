<?php
require '../php/conndis_mysql.php';
require	'../php/geturlquery.php';
require '../php/cookieverify.php';
require '../php/lang_identify_funcs.php';

$ml_headers = lang_ml_header();
$ml_header = $ml_headers[0];
$ml_header_link = $ml_headers[1];
$lang = $ml_headers[2];

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
<HTML lang = "<?php echo $lang ?>">
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
<script src="../js/mod_url_params.js"></script>
<script src="../js/langchangelistener.js"></script>
</HTML>