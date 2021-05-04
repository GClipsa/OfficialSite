<?php
	include "../php/getsoftwarecontent_mysql.php";
	require '../php/cookieverify.php';
	require '../php/lang_identify_funcs.php';

	$come = getsoftwarecontent();

	$ml_headers = lang_ml_header();
	$ml_header = $ml_headers[0];
	$ml_header_link = $ml_headers[1];
	$lang = $ml_headers[2];
?>
<!doctype html>
<HTML lang = "<?php echo $lang ?>">
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/software_content_mainbody.css">
<link rel="stylesheet" type="text/css" href="../css/magnific-popup.css">

<TITLE>GClipsa Software: <?php echo $come['name']?></TITLE> 
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
					<h1 class="welcome_text"><?php echo $come['name']?></h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="video_box">
							<div class="videopic">
								<div class="video_buffer">
									<iframe class="video_buffer_item"
											src="https://www.youtube.com/embed/<?php echo $come['video']?>"
							    			frameborder="0"
							    			allow="accelerometer; autoplay; fullscreen; encrypted-media; gyroscope; picture-in-picture"
							    			allowfullscreen>
									</iframe>
								</div>
							</div>
							<div class="devbox">
								<div class="dev_slider">
									<?php 	
										$pictures =  explode(",",$come['pictures']);
										foreach ($pictures as $img) 
										{
									?>
									<div class="dev_slider_item">
										<a class="popup" href="<?php echo $img ?>"><img src="<?php echo $img ?>" alt="p1.jpg"></a>
									</div>
									<?php  	
										} 
									?>
								</div>	
							</div>								
						</div>
						<div class="info_box">
							<div class="info_box_header">
								<h2 class="info_box_header_p"><?php echo $come['header']?></h2>
								<img class="undrln_small" src="../svg/underline.svg" alt="underline.svg">
							</div>
							<div class="text_info">
								<p class="text_info_p"><?php echo $come['data']?></p>
							</div>
							<div class="undrln_pic">
								<img class="undrln_big" src="../svg/underline.svg" alt="underline.svg">
							</div>
							<div class="downbuy">
								<div class="downbuy_pic">
									<img class="downbuy_pic_img" src="../svg/<?php echo $come['gettype']?>.svg" alt="<?php echo $come['gettype']?>.svg">
								</div>
								<p class="downbuy_text_p"><?php echo $come['gettype']?></p>
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
<script src="../js/slick.min.js"></script>
<script src="../js/soft_content_slider.js"></script>
<script src="../js/magnific-popup.min.js"></script>
<script src="../js/popup_image.js"></script>
<script src="../js/mod_url_params.js"></script>
<script src="../js/langchangelistener.js"></script>
</HTML>