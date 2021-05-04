<?php
	include "../php/getsoftware_mysql.php";
	require "../php/getalternativelinks.php";
	require '../php/cookieverify.php';
	require '../php/lang_identify_funcs.php';

	$result = getsoftwarenames();
	$popprograms = getpop();
	$altind = getalternativelinks("SELECT link FROM presoftware");

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

<link rel="canonical" href="https://gclipsa.com/pages/software">

<title>Visit our software company GClipsa and get free software</title> 
<meta property="og:title" content="Visit our software company GClipsa and get free software">
<meta name="robots" content="index, follow"> 
<meta name="description" content="We create high quality software products and we have good free software right for you! Downloand our software - parsers, telegram and twitch bots, twitch manager. Come on and get your high quality software product." >
<meta property="og:description" content="We create high quality software products and we have good free software right for you! Downloand our software - parsers, telegram and twitch bots, twitch manager. Come on and get your high quality software product.">

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/software_mainbody.css">

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
					<h1 class="welcome_text">SOFTWARE OF PROJECT GCLIPSA</h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="allprograms">
							<div class="allprograms_box_list">
								<div class="allprograms_double_box">
									<div class="allprograms_header">
										<p class="header_text">ALL PROGRAMS</p>
										<img class="undrln_small" src="../svg/underline.svg" alt="underline.svg">
									</div>									
									<div class="list">
										<input type="text" id="List_find" class="list_find" placeholder="Search for names.." title="Type in a name">
										<ul class="filter_ul" id="Filter_ul">
										  <li><a href="#">all</a></li>
										  <li><a href="#">for games</a></li>
										  <li><a href="#">global</a></li>
										</ul>
										<ul class="list_ul" id="List_ul">
											<?php
											foreach ($result as $name)	
											{
											?>
											<li class="name_list_li"><a><?php echo $name?></a></li>
											<?php
											}
											?>
										</ul>
									</div>
								</div>
							</div>

							<div class="allprograms_box_info">
								<div class="allprograms_double_info_box"  id="Allprograms_double_info_box">
									<div class="info_pic">
										<img class="info_pic_img" src="../images/p2.jpg" alt="p2.jpg">
									</div>
									<div class="info_text">
										<p class="info_text_p">Some interesting information for users about this software.Some interesting information for users about this software.Some interesting information for users about this software.Some interesting information for users about this software.</p>
									</div>
									<a href="#"><div class="info_button">
										<p class="info_button_text">GO TO PAGE</p>
									</div></a>
								</div>
							</div>
						</div>
						<div class="popprograms">
							<div class="popprograms_header">
								<p class="header_text">POPULAR PROGRAMS</p>
								<img class="undrln_small" src="../svg/underline.svg" alt="underline.svg">
							</div>
							<div class="devbox">
								<div class="dev_slider">
									<?php
										foreach ($popprograms as $come)	
									{
									?>
									<div class="dev_slider_item">
										<div class="karta">
											<div class="karta_pic">
												<img class="karta_pic_img" src="<?php echo $come->picture?>" alt="<?php echo $come->picture?>">
											</div>
											<div class="karta_text">
												<p class="karta_text_p"><?php echo $come->description?></p>
											</div>
										</div>
									</div>
									<?php
									}
									?>
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
<?php
foreach ($altind as $altinder) 
{
?>
<a href="<?php echo $altinder ?>"></a>
<?php
}
?>
<!-- JS -->
<script src="../js/jquery.js"></script>
<script src="../js/burgmenu.js"></script>
<script src="../js/opacAnimating.js"></script>
<script src="../js/finderfilter.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/soft_slider.js"></script>
<script src="../js/softwarechanger.js"></script>
<script src="../js/mod_url_params.js"></script>
<script src="../js/langchangelistener.js"></script>
</HTML>