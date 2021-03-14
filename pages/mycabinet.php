<?php
	require '../php/conndis_mysql.php';
	require '../php/getuserinfo.php';
	require '../php/getuserorders.php';
	require '../php/cookieverify.php';
	// var_dump($_SESSION['user']);
	// var_dump(session_id());
	if($_SESSION['user'])
	{
		$userinfo = getuserinfo($_SESSION['user']->id);
		$userorders = getuserorders($username);
		$numbers = getnumberalluserorders($username);
	}else{header("Location: /pages/identification.php");}
?>
<!doctype html>
<HTML> 
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/mycabinet_mainbody.css">
<link rel="stylesheet" type="text/css" href="../css/tooltip.css">
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
					<h1 class="welcome_text">your cabinet</h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="leftmenu">
							<div class="l_username">
								<p><?php echo $username ?></p>
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
							<div class="l_purchases button prelast" id="L_purchases">
								<p>MY PURCHASES</p>
							</div>
							<div class="l_signout button" id="L_signout">
								<p>SIGN OUT</p>
							</div>
						</div>

						<div class="rightmenu">

							<div class="r_profile_box" id="R_profile_box">
								<div class="rpb_name">
									<p>PROFILE SETTINGS</p>
								</div>

								<div class="rpb_acc_status">
									<p>ACCOUNT STATUS: <?php echo $userinfo->status ?></p>
								</div>

								<div class="rpb_mail_box">
									<div class="rpb_mail">
										<p><?php echo $userinfo->email ?></p>
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
									<div class="rpb_confirm rpb_button">
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

								<div class="rpb_change_email rpb_button">
									<p>CHANGE EMAIL</p>
								</div>

								<div class="rpb_change_password rpb_button">
									<p>CHANGE PASSWORD</p>
								</div>
							</div>

							<div class="r_my_purch_box" id="R_my_purch_box">

								<div class="rmb_name_box">
									<div class="rmb_total">
										<p>TOTAL PURCHASES: <?php echo $numbers ?></p>
									</div>
									<div class="rmb_name">
										<p>MY PURCHASES</p>
									</div>
									<div class="rmb_total1">
										<p>TOTAL PURCHASES: <?php echo $numbers ?></p>
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
<script src="../js/mycabinet.js"></script>
<script src="../js/tooltip.js"></script>

</HTML>