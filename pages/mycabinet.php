<?php
	require '../php/conndis_mysql.php';
	require '../php/getuserinfo.php';
	require '../php/getuserorders.php';
	require '../php/cookieverify.php';
	require '../php/obfuscatemail.php';
	require '../php/lang_identify_funcs.php';

	$ml_headers = lang_ml_header();
	$ml_header = $ml_headers[0];
	$ml_header_link = $ml_headers[1];
	$lang = $ml_headers[2];

	if($_SESSION['user'])
	{
		$userinfo = getuserinfo($_SESSION['user']->id);
		$userorders = getuserorders($username);
		$numbers = getnumberalluserorders($username);
	}else{header("Location: /pages/identification.php");}
?>
<!doctype html>
<HTML lang = "<?php echo $lang ?>">
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/mycabinet_mainbody.css">
<link rel="stylesheet" type="text/css" href="../css/toast.css">
<link rel="stylesheet" type="text/css" href="../css/tooltip.css">
<link rel="stylesheet" type="text/css" href="../css/modalwin.css">
<TITLE>GClipsa Cabinet</TITLE> 
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
					<h1 class="welcome_text">your cabinet</h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="leftmenu">
							<div class="l_username_group">
								<!-- <div class="l_support_pic">
									<img src="../svg/wallet.svg" alt="wallet.svg">
								</div> -->
								<div class="l_username">
									<p><?php echo $username ?></p>
								</div>
								<div class="l_support_pic">
									<img src="../svg/support.svg" alt="support.svg">
								</div>
							</div>
							<div class="l_balance_group">
								<div class="l_balance">
									<p>CLIPS BALANCE</p>
								</div>
								<div class="l_balance_int">
									<p><?php echo $userinfo->clips ?></p>
								</div>
								<div class="l_balance_pic">
									<div class="l_balance_pic_buff">
									<img src="../svg/wallet.svg" alt="wallet.svg">
									</div>
								</div>
							</div>
							<div class="l_profile_sett button" id="L_profile_sett">
								<p>PROFILE SETTINGS</p>
							</div>
							<?php if($userinfo->status == "client") { ?>
							<div class="l_purchases button prelast" id="L_purchases">
								<p>SERVICE PURCHASES</p>
							</div>
							<?php 
							} 
							else if($userinfo->status == "developer") { ?>
							<div class="l_purchases button" id="L_purchases">
								<p>SERVICE PURCHASES</p>
							</div>
							<div class="l_wallet button prelast" id="L_wallet">
								<p>BUSINESS PANEL</p>
							</div>
							<?php } ?>
							<div class="l_signout button" id="L_signout">
								<p>SIGN OUT</p>
							</div>
						</div>

						<div class="rightmenu">
							<div class="rightmenu_buff">
								<div class="r_profile_box" id="R_profile_box">
									<div class="rpb_name">
										<p>PROFILE SETTINGS</p>
									</div>

									<div class="rpb_acc_status">
										<p>ACCOUNT STATUS: <?php echo $userinfo->status ?></p>
									</div>

									<div class="rpb_mail_box">
										<div class="rpb_mail">
											<p><?php echo obfuscate_email($userinfo->email) ?></p>
										</div>
										<div class="rpb_verify">
											<div class="rpb_verify_buff">
												<?php if($userinfo->verified == 0) { ?>
												<img src="../svg/delete.svg" alt="delete.svg">
												<?php 
												} else if($userinfo->verified == 1) { ?>
												<img src="../svg/check.svg" alt="check.svg">
												<?php 
												}
												?>
											</div>
										</div>
										<?php if($userinfo->verified == 0) { ?>
										<div class="rpb_confirm rpb_button"  id="Rpb_confirm">
											<p>CONFIRM EMAIL</p>
										</div>
										<?php 
										} else if($userinfo->verified == 1) { ?>
										<div class="rpb_confirmed">
											<p>Email confirmed</p>
										</div>
										<?php 
										}
										?>
									</div>

									<div class="rpb_change_email rpb_button" id="Rpb_change_email">
										<p>CHANGE EMAIL</p>
									</div>

									<div class="rpb_change_password rpb_button" id="Rpb_change_password">
										<p>CHANGE PASSWORD</p>
									</div>
								</div>
								<!-- --------------- !CHANGE PASS ----------------- -->
								<div class="r_profile_changepass_box" id="R_profile_changepass_box">
									<div class="rpc_name">
										<p>CHANGING PASSWORD</p>
									</div>
									<div class="rpc_oldpass_warn"><p id="row">Some old password warning for people.</p></div>
									<div class="rpc_oldpass">
										<img class="rpc_oldpass_pic" src="../svg/password.svg" alt="password.svg">
										<input type="password" id="Rpc_oldpass_text" placeholder="Your old password...">
									</div>
									<div class="rpc_newpass_warn rpc_oldpass_warn"><p id="rnew">Some new password warning for people.</p></div>
									<div class="rpc_newpass rpc_oldpass">
										<img class="rpc_newpass_pic rpc_oldpass_pic" src="../svg/password.svg" alt="password.svg">
										<input type="password" id="Rpc_newpass_text" placeholder="Your new password...">
									</div>
									<div class="rpc_newrepass_warn rpc_oldpass_warn"><p id="rrew">Some new repassword warning for people.</p></div>
									<div class="rpc_newrepass rpc_oldpass">
										<img class="rpc_newrepass_pic rpc_oldpass_pic" src="../svg/password.svg" alt="password.svg">
										<input type="password" id="Rpc_newrepass_text" placeholder="Repeat your new password...">
									</div>
									<div class="rpc_submit">
										<div class="rpc_submit_btn" id="Rpc_submit_btn"> <p id="Rpc_submit_btn_p">CHANGE PASSWORD</p> </div>
									</div>
								</div>
								<!-- -------------------------------- -->

								<!-- --------------- !CHANGE EMAIL ----------------- -->
								<div class="r_profile_changeemail_box" id="R_profile_changeemail_box">
									<div class="rfc_name rpc_name">
										<p>CHANGING EMAIL</p>
									</div>
									<div class="rfc_pass_warn"><p id="rpw">Some password warning for people.</p></div>
									<div class="rfc_pass">
										<img class="rfc_pass_pic" src="../svg/password.svg" alt="password.svg">
										<input type="password" id="Rfc_pass_text" placeholder="Your password...">
									</div>
									<div class="rfc_newemail_warn rfc_pass_warn"><p id="rnw">Some new email warning for people.</p></div>
									<div class="rfc_newemail rfc_pass">
										<img class="rfc_newemail_pic rfc_pass_pic" src="../svg/email.svg" alt="email.svg">
										<input type="text" id="Rfc_newemail_text" placeholder="Your new email...">
									</div>
									<div class="rfc_renewemail_warn rfc_pass_warn"><p id="rrw">Some renew email warning for people.</p></div>
									<div class="rfc_renewemail rfc_pass">
										<img class="rfc_renewemail_pic rfc_pass_pic" src="../svg/email.svg" alt="email.svg">
										<input type="text" id="Rfc_renewemail_text" placeholder="Repeat your new email...">
									</div>
									<div class="rfc_submit">
										<div class="rfc_submit_btn" id="Rfc_submit_btn"> <p id="Rfc_submit_btn_p">CHANGE EMAIL</p> </div>
									</div>
								</div>
								<!-- -------------------------------- -->
								<div class="r_my_purch_box" id="R_my_purch_box">

									<div class="rmb_name_box">
										<div class="rmb_total_soft">
											<p>SOFTWARE PURCHASES: <?php echo $numbers ?></p>
										</div>
										<div class="rmb_name">
											<p>SOFTWARE PURCHASES</p>
										</div>
										<div class="rmb_total_orders">
											<p>SERVICE ORDERS: <?php echo $numbers ?></p>
										</div>
									</div>
									<div class="rmb_list">
									<div id="tooltip"></div>
										<ul class="list_ul" id="List_ul">
											<li class="list_li_box">
												<div class="pj_name"> <p>Name of product</p> </div>
												<div class="pj_code"> <p>Code</p> </div>
												<div class="ser_num"> <p>Serial number</p> </div>
												<div class="date"> <p>bought</p> </div>
												<div class="date"> <p>Activating</p> </div>
												<div class="date"> <p>Deactivating</p> </div>
												<div class="price"> <p>price</p> </div>
											</li>
											<?php
												foreach ($userorders as $come) 
												{
											?>
											<li class="list_li_box list_li_box_nothead">
												<div class="pj_name"> <p><?php echo $come->name ?></p> </div>
												<div class="pj_code"> <p><?php echo $come->productcode ?></p> </div>
												<div class="ser_num" data-tooltip="Copied!"> <p> <?php echo $come->sernum ?></p> </div>
												<div class="date"> <p><?php echo $come->datebuy ?></p> </div>
												<div class="date"> <p><?php echo $come->datestart ?></p> </div>
												<div class="date"> <p><?php echo $come->datefinish ?></p> </div>
												<div class="price"> <p><?php echo $come->price ?></p> </div>
											</li>
											<?php
												}
											?>
										</ul>
									</div>
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
<script type="module" src="../js/mycabinet.js"></script>
<script src="../js/mod_url_params.js"></script>
<script src="../js/langchangelistener.js"></script>
</HTML>
